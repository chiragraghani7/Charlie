<?php 
require_once("includes/admin-bootstrap.php");

Session::start_session();
?>
<div class="table-responsive">
	<table class="table" id="author_posts">
		<thead class="thead-dark">
			<tr>
				<th>Post Image</th>
				<th hidden>post_id</th>
				<th>Post Category</th>
				<th>Post Title</th>
				<th>Post Body</th>
				<th>Post Tags</th>
				<th>Post Status</th>
				<th>Post Date</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
		$db = new Database();
		$conn = $db->getConnection();
		$category  = new Categories($conn);
		$post = new Posts($conn);
		$start = ($_REQUEST['page_no']-1)*MAX_PAGE_CONTENT;
		$result = $post->readAllPostsOfAuthor($_SESSION['user_id']);
        //echo $_SESSION['user_id'];
        //var_dump($result);
		$count = count($result);
		$result = $post->readAllPostsOfAuthor($_SESSION['user_id'], $start, MAX_PAGE_CONTENT);
		for($i = 0; $i < count($result); $i++){
			$res = $category->getCategoryById($result[$i]['post_category_id']);
			$image = POSTIMAGES."".$result[$i]['post_image'];
			echo<<<TAG
			
			<tr>
				<td><img src="{$image}" alt="{$result[$i]['post_title']}" width="150px"></img></td>
				<td hidden>{$result[$i]['post_id']}</td>
				<td>{$res['category_name']}</td>
				<td>{$result[$i]['post_title']}</td>
				<td>{$result[$i]['post_body']}</td>
				<td>{$result[$i]['post_tags']}</td>
				<td name='post_status'>{$result[$i]['post_status']}</td>
				<td>{$result[$i]['post_date']}</td>
				<td><button class='edit fa fa-pen btn btn-info' id='{$result[$i]['post_id']}' data-toggle='modal' data-target='#EditModal'> Edit</button></td>
				<td><button class='delete fa fa-trash btn btn-danger' id='{$result[$i]['post_id']}' data-toggle='modal' data-target='#deleteModal' name='deleteBtn'> DELETE</button></td>
				<td><button class='toggle fa fa-toggle-off btn btn-success' id='{$result[$i]['post_id']}' data-toggle='modal' data-target='#statusToggleModel' name='toggleBtn'> Toggle Status</button></td>
			</tr>
TAG;
		}
		?>

		</tbody>
	</table>
	<ul class="pagination justify-content-center">
		<li class="page-item <?php if(($_REQUEST['page_no']-1) <= 0){echo " disabled";}?>"><a class="page-link" href="<?php echo BASEURL."admin/posts/managePosts/".($_REQUEST['page_no']-1);?>">Previous </a> </li> <li class="page-item active"><a class="page-link" href="<?php echo BASEURL."admin/posts/managePosts/".$_REQUEST['page_no'];?>"> <?php echo $_REQUEST['page_no'];?></a></li>
		<li class="page-item <?php if(($start+MAX_PAGE_CONTENT) >= ($count)){echo " disabled";}?>"><a class="page-link" href="<?php echo BASEURL."admin/posts/managePosts/".($_REQUEST['page_no']+1);?>"> <?php echo ($_REQUEST['page_no']+1);?></a></li>
		<li class="page-item <?php if(($start+MAX_PAGE_CONTENT) >= ($count)){echo " disabled";}?>"><a class="page-link" href="<?php echo BASEURL."admin/posts/managePosts/".($_REQUEST['page_no']+1);?>">Next </a> </li> </ul> </div> 
			<div class="row">
				<div class="col-md-12">
<!--					Delete Modal-->
					<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Delete??</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Are you sure want to delete This Post!!!</p>
							</div>
							<div class="modal-footer">
								<form action="../../edit_posts" method="POST">
									<input type="hidden" id="deleteID" name="post_id">
									<button type="submit" class="btn red" name="deleteBtn">YES</button>
									<button type="button" class="btn blue" data-dismiss="modal">NO</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--END OF DELETE MODAL-->

				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
<!--					Delete Modal-->
					<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Edit??</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Are you sure want to Edit This Post!!!</p>
							</div>
							<div class="modal-footer">
								<form action="../../edit_posts" method="POST">
									<input type="hidden" id="editID" name="post_id">
									<button type="submit" class="btn red" name="deleteBtn">YES</button>
									<button type="button" class="btn blue" data-dismiss="modal">NO</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--END OF Edit MODAL-->

				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
<!--					Delete Modal-->
					<div class="modal fade" id="statusToggleModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Change Status??</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Are you sure want to change the status of this Post!!!</p>
							</div>
							<div class="modal-footer">
								<form action="../../edit_posts" method="POST">
									<input type="hidden" id="toggleID" name="post_id">
									<button type="submit" class="btn red" name="toggleBtn">YES</button>
									<button type="button" class="btn blue" data-dismiss="modal">NO</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--END OF Status Toggle MODAL-->

				</div>
			</div>
				
			