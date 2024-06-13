@extends('admin.layouts.app')

@section('content')


				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Shop</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="categories.html" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">

                    <form action="" method="post" id="shopform" name="shopform">
						<div class="card">
							<div class="card-body">								
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                                            <p></p>
										</div>
									</div>
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Create</button>
							<a href="brands.html" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>

                    </form>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->
			
@endsection

@section('customjs')
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $('#shopform').submit(function(event) {
        event.preventDefault();
        var element = $(this);

		$("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: '{{ route("shops.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response) {

				console.log(response);
				
				// return false;




                if(response["status"] == true) {

					// console.log(test);

					window.location.href="{{ route('shops.index') }}";

                    $('#name').removeClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html("");
                }

               else {

                    var errors = response['errors'];

                    $('#name').addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback').html(errors['name']);

                }

            },
            error: function(jqXHR,exception){

                console.log("something error");

            }
        })
    });

</script>
@endsection