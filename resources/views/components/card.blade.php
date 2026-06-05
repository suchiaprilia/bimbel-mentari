<div class="card mb-3">

  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title mb-0">{{ $title }}</h3>

    @if(!empty($collapse))
      <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#cardBody{{ $id ?? 'default' }}">
        <i class="fas fa-plus"></i>
      </button>
    @endif
  </div>

  <div id="cardBody{{ $id ?? 'default' }}" class="{{ !empty($collapse) ? 'collapse' : '' }} {{ !empty($show) ? 'show' : '' }}">
    <div class="card-body">
      {{ $slot }}
    </div>
  </div>

</div>