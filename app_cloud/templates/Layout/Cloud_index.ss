<div class="container">
<div class="row">
    <div class="col-sm-12">
    <h1>$Title</h1>
	<p>$Content</p>
	<% if $MyBoxes %>
	<h2>My Boxes</h2>
    <table class="table">
        <thead>
			<tr class="active">
				<th>ID</th>
				<th>Title</th>
				<th>Description</th>
				<th>Versions</th>
				<th>URL</th>
				<th>Bearbeiten</th>
			</tr>
		</thead>
		<tbody>
		<% loop $MyBoxes %>
			<tr>
				<td>$ID</td>
				<td>$Title</td>
				<td>$Description</td>
				<td>
					<% if $Versions %>
					<ul>
					<% loop $Versions %>
					<li>$Version</li>
					<% end_loop %>
					</ul>
					<% end_if %>
				</td>
				<td>$Link</td>
				<td><a href="box/addVersion/$ID" class="btn btn-info">Add Version</a><br /><a href="box/editDescription/$ID" class="btn btn-warning">Edit Description</a></td>
			</tr>
        <% end_loop %>
		</tbody>
	</table>
	<% end_if %>
	<% if $PublicBoxes %>
	<h2>Public Boxes</h2>
	<table class="table">
		<thead>
			<tr class="active">
				<th>ID</th>
				<th>Title</th>
				<th>Description</th>
				<td>
					<% if $Versions %>
					<ul>
					<% loop $Versions %>
					<li>$Version</li>
					<% end_loop %>
					</ul>
					<% end_if %>
				</td>
				<th>Versions</th>
				<th>URL</th>
			</tr>
		</thead>
		<tbody>
        <% loop $PublicBoxes %>
			<tr>
				<td>$ID</td>
				<td>$Title</td>
				<td>$Description</td>
				<td>$Link</td>
			</tr>
        <% end_loop %>
		</tbody>
		<% end_if %>
    </table>
    </div>
</div>
</div>