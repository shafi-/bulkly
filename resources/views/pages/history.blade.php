@extends('layouts.app')

@section('content')
<div id="history_content" class="container-fluid app-body">
  <div class="card card-bordered">
    <div class="card-header"></div>
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <div class="col">
            <icon class="fa fa-search"></icon>
            <input type="text" v-model="search.text" class="form-input w-75">
          </div>
          <div class="col">
            <input type="date" v-model="search.time" class="form-input">
          </div>
          <div class="col">
            <select v-model="search.group">
              <option :value="-1">All Group</option>
              <option v-for="group in groups" :key="group.id" :value="group.id">@{{ group.name }}</option>
            </select>
          </div>
        </div>
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Group Name</th>
              <th>Group Type</th>
              <th>Account Name</th>
              <th>Post Text</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in showablePosts" :key="post.id">
              <td>@{{ post.group_info ? post.group_info.name : 'no-group-info' }}</td>
              <td>@{{ post.group_info ? post.group_info.type : 'no-group-info' }}</td>
              <td>@{{ post.account_info ? post.account_info.name : 'no-acc-info' }}</td>
              <td>@{{ post.post_text }}</td>
              <td>@{{ post.sent_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer">
      <div class="col-12">
        <a class="btn btn-sm" @click="prevPage">
        </a>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/history.js') }}"></script>
@endsection

