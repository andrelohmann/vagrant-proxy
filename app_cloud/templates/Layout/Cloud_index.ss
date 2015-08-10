<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1>$Title</h1>
            <% if $Boxes %>
            <ul>
                <% loop $Boxes %>
                <li>$Name - $Description</li>
                <% end_loop %>
            </ul>
            <% end_if %>
        </div>
    </div>
</div>