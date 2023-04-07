@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : "Settings")
@section('content')

<div class="row align-items-center">
    <div class="col">
        <h2 class="pageTitle">
            Settings
        </h2>
    </div>
</div>
<div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <a href="#tabs-home-14" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">General Settings</a>
        </li>
        <li class="nav-item" role="presentation">
          <a href="#tabs-profile-14" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Logo & Favicon</a>
        </li>
        <li class="nav-item" role="presentation">
          <a href="#tabs-activity-14" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Social Media</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane fade active show" id="tabs-home-14" role="tabpanel">
         @livewire('author-general-settings')
        </div>
        <div class="tab-pane fade" id="tabs-profile-14" role="tabpanel">
          <h4>Logo & Favicon</h4>
          <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
        </div>
        <div class="tab-pane fade" id="tabs-activity-14" role="tabpanel">
          <h4>Social Media</h4>
          <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit mauris accumsan nibh habitant senectus</div>
        </div>
      </div>
    </div>
</div>

@endsection

