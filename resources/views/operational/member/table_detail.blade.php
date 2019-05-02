

<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title" id="myModalLabel">Article Post</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="category"> <b>Created</b> </label>
											<p>{{ $data[0]->om_created_at }}</p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="tags"> <b>Date</b></label>
											<p>{{ date('Y-m-d',strtotime($data[0]->om_date)) }}</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="category"> <b>OP</b></label>
											<p>{{ $data[0]->name }}</p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="tags"> <b>E-mail</b></label>
											<p>{{ $data[0]->om_email }}</p>
										</div>
									</div>
								</div> 
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="category"> <b>Phone</b></label>
											<p>{{ $data[0]->om_phone1 }}</p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="tags"> <b>Phone 1</b></label>
											<p>{{ $data[0]->om_phone2 }}</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="category"> <b>Line</b></label>
											<p>{{ $data[0]->om_line }}</p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="tags"> <b>BBM</b></label>
											<p>{{ $data[0]->om_bbm }}</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="category"> <b>Name rek</b></label>
											<p>{{ $data[0]->om_name_rek }}</p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="tags"> <b>No Rek</b></label>
											<p>{{ $data[0]->om_no_rek }}</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="category"> <b>Notes</b></label>
											<p>{{ $data[0]->om_notes }}</p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="tags"> <b>No Referal</b></label>
											<p>{{ $data[0]->om_no_referal }}</p>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Cancel
								</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->