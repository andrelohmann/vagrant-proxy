<div class="container">
<div class="row">
    <div class="col-sm-12">
    <h1>$Title</h1>
	
	<% if $MyBoxes %>
	<h2>My Boxes</h2>
    <table class="table">
        <thead>
			<tr class="active">
				<th>ID</th>
				<th>Title</th>
				<th>Description</th>
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
				<td>$Link</td>
				<td><a href="boxadmin/boxEdit/$ID" class="btn btn-warning">Bearbeiten</a></td>
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