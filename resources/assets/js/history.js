const Vue = require('vue')
const axios = require('axios')

const api = axios.create()

const baseURL = '/api';

const history = new Vue({
  el: '#history_content',
  data() {
    return {
      posts: [],
      groups: [],
      search: {
        text: '',
        time: undefined,
        group: -1,
      },
      paginagtion: {
        perPage: 10,
        current: 1
      },
      errors: []
    }
  },
  created() {
    this.fetchPosts();
    this.fetchGroups();
  },
  methods: {
    fetchGroups () {
      this.apiCall('/groups').then(res => {
        this.groups = res.data
      }).catch(err => {
        this.errors.push(err)
      })
    },
    fetchPosts () {
      this.apiCall('/posts').then(res => {
        this.posts = res.data
      }).catch(err => {
        this.errors.push(err)
      })
    },
    apiCall (path) {
      return api.get(baseURL + path)
    },
    filterPosts () {
      let text = this.search.text;
      let time = this.search.time;
      let group = this.search.group;

      return this.posts.filter(post => {
        let matched = true;
        if (text) matched = matched && this.matchText(post, text);
        // if (time) matched = matched && this.matchTime(post.time, time);
        if (group != -1) matched = matched && post.group_info.id === group;
        return matched;
      })
    },
    matchTime(t1, t2) {
      let dt1 = new Date(t1);
      let dt2 = new Date(t2);
      return (dt1.getFullYear() === dt2.getFullYear() &&
        dt1.getMonth() === dt2.getMonth() && 
        dt1.getDate() === dt2.getDate())
    },
    matchText(post, text) {
      return (post.group_info.name === text ||
          post.post_text === text ||
          post.account_info.type === text
        )
    },
    prevPage() {
      this.current -= 1;
    },
    nextPage() {
      this.paginagtion.current += 1      
    },
    gotoPage(page) {
      this.paginagtion.current = page
    }
  },
  computed: {
    showablePosts () {
      let posts = this.filterPosts() || [];
      let count = posts.length;
      let start = this.paginagtion.perPage * (this.paginagtion.current - 1) + 1;
      let end = start + this.paginagtion.perPage;

      let postsToShow = [];
      for (let i = start; i < count && i <= end; i++) postsToShow.push(posts[i]);
      return postsToShow;
    }
  }
})