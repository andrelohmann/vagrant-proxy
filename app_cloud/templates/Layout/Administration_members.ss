<div class="container">
<div class="row">
    <div class="col-md-12">
    <h1>$Title</h1>
    <% if $Members %>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Email</th>
            <th>Admin<a title="" data-toggle="tooltip" href="#" data-original-title="Benutzer hat Administratoren-Rechte"><i class="glyphicon glyphicon-question-sign"></i></a></th>
            <th>Author<a title="" data-toggle="tooltip" href="#" data-original-title="Benutzer hat Authoren-Rechte"><i class="glyphicon glyphicon-question-sign"></i></a></th>
            <th>Bearbeiten</th>
        </tr>
        <% loop $Members %>
        <tr>
            <td>$ID</td>
            <td>$FirstName</td>
            <td>$Surname</td>
            <td>$Email</td>
            <td><% if $IsAdmin %><i class="glyphicon glyphicon-ok"></i><% end_if %></td>
            <td><% if $IsContentAuthor %><i class="glyphicon glyphicon-ok"></i><% end_if %></td>
            <td><a href="administration/memberEdit/$ID" class="btn btn-warning">Bearbeiten</a></td>
        </tr>
        <% end_loop %>
    </table>
    <% else %>
    <p>Es wurden noch keine Benutzer angelegt.</p>
    <% end_if %>
    <a href="administration/memberAdd" class="btn btn-primary">Benutzer hinzufügen</a>
    </div>
</div>
</div>
