@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome Back, {{ auth()->user()->name }}</h1>
</div>

@can('admin')
<div class="row row-cols-1 row-cols-md-3 g-4 py-5">
  <div class="col-md-4">
      <div class="card " style="border-radius: 10px;">
          <div class="card-body">
              <h2 class="p-3 "><i class="bi bi-person"></i> USER</h2>
              <div class="ms-3 mt-0">
                  <h2>
                    {{ $user }}
                  </h2>
              </div>
          </div>
      </div>
  </div>
  <div class="col-md-4">
      <div class="card " style="border-radius: 10px;">
          <div class="card-body">
              <h2 class="p-3 "><i class="bi bi-file-earmark-text"></i> POST</h2>
              <div class="ms-3 mt-0">
                  <h2>
                    {{ $post }}
                  </h2>
              </div>
          </div>
      </div>
  </div>
  <div class="col-md-4">
      <div class="card " style="border-radius: 10px;">
          <div class="card-body">
              <h2 class="p-3 "><i class="bi bi-bounding-box"></i> KATEGORI</h2>
              <div class="ms-3 mt-0">
                  <h2>
                    {{ $category }}
                  </h2>
              </div>
          </div>
      </div>
  </div>
</div>
@endcan

<div class="row justify-content-center">
  <div class="col-lg-2">
    <p class="fs-6">{{ (auth()->user()->is_admin) ? 'Top 10 view all post' : 'Top 10 view of your post' }}</p>
  </div>
</div>

<canvas class="my-4 w-100" id="chartViewer" width="900" height="380">Top 10 Views</canvas>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
 $(function(){
      var cData = JSON.parse(`<?php echo $chart_data; ?>`);
      var ctx = $("#chartViewer");
 
      //bar chart data
      var data = {
        labels: cData.label,
      datasets: [{
        label: 'view',
        data: cData.data,
        borderWidth: 1
      }]
    };
 
      //options
      var options = {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
 
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
        options: options
      });
 
  });
  
</script>
@endsection