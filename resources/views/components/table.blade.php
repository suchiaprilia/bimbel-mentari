<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">

    <thead class="bg-light">
      <tr>
        {{ $thead }}
      </tr>
    </thead>

    <tbody>
      {{ $slot }}
    </tbody>

  </table>
</div>

<style>
.table th, .table td {
  vertical-align: middle;
}

.table td:last-child {
  white-space: nowrap;
}

.btn-sm {
  padding: 3px 8px;
  font-size: 12px;
}
</style>