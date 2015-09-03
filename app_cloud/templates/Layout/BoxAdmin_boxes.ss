<div class="container">
<div class="row">
    <div class="col-md-12">
    <h1>$Title</h1>
    <% if $Boxes %>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Public</th>
            <th>Bearbeiten</th>
        </tr>
        <% loop $Boxes %>
        <tr>
            <td>$ID</td>
            <td>$Title</td>
            <td>$Description</td>
            <td><% if $Public %><i class="glyphicon glyphicon-ok"></i><% end_if %></td>
            <td><a href="boxadmin/boxEdit/$ID" class="btn btn-warning">Bearbeiten</a></td>
        </tr>
        <% end_loop %>
    </table>
    <% else %>
    <p>Es wurden noch keine Boxen angelegt.</p>
    <% end_if %>
    <a href="boxadmin/boxAdd" class="btn btn-primary">Box hinzufügen</a>
    </div>
</div>
</div>
