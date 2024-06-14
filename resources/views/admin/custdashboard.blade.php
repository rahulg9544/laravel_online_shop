@extends('admin.custlayouts.app')

@section('content')

				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Dashboard</h1>
							</div>
							<div class="col-sm-6">
								
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="row">

						@if($products->isNotEmpty())

                                        @foreach($products as $product)
							<div class="col-lg-4 col-6">							
								<div class="small-box card">
									<div class="inner">
										<h3>{{ $product->quantity }}</h3>
										<p>{{ $product->product_name }}</p>
									</div>
									<div class="icon">
										<i class="ion ion-bag"></i>
									</div>
									<a href="#" class="small-box-footer text-dark">Add to cart<i class="fas fa-arrow-circle-right"></i></a>
								</div>

								@endforeach

@else

@endif

							</div>
							
						</div>
					</div>					
					<!-- /.card -->
				</section>
				<!-- /.content -->
@endsection

@section('customjs')
<script>
    console.log("hello")
</script>
@endsection