<!DOCTYPE html>
<html>
    <head>
        <% base_tag %>
        <title>$Title</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        $MetaTags(false)
        
    </head>
    <body id="page-top">
        <nav id="top-nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container"><!-- This container will center the Navbar Contents to the fluid width, by uncommenting it, the whole width will be used -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home/index">Vagrant-Cloud</a>
                </div>

                <div class="collapse navbar-collapse" id="top-navigation">
                    <% if $CurrentMember %>
                    <ul class="nav navbar-nav">
                        <li class="<% if $URLPath == cloud/index %>active<% end_if %>"><a href="cloud/index"><%t TopMenu.CLOUD "TopMenu.CLOUD" %></a></li>
                    </ul>
                    <% end_if %>
                    <% if $CurrentMember %>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="<% if $URLSegment == passwordadmin %>active<% end_if %>"><a href="passwordadmin/index"><%t PasswordMenu.CHANGEPASSWORD "PasswordMenu.CHANGEPASSWORD" %></a></li>
                        <% if $CurrentMember.IsAdmin %>
                        <li class="dropdown<% if $URLTopic == administration %> active<% end_if %>"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><%t AdminMenu.ADMIN "AdminMenu.ADMIN" %> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="<% if $URLPath == boxadmin/boxes %>active<% end_if %>"><a href="boxadmin/boxes"><%t BoxAdminMenu.BOXES "BoxAdminMenu.BOXES" %></a></li>
                                <li class="<% if $URLPath == boxadmin/boxAdd %>active<% end_if %>"><a href="boxadmin/boxAdd"><%t BoxAdminMenu.ADDBOX "BoxAdminMenu.ADDBOX" %></a></li>
                                <li class="<% if $URLPath == administration/members %>active<% end_if %>"><a href="administration/members"><%t AdminMenu.MEMBERS "AdminMenu.MEMBERS" %></a></li>
                                <li class="<% if $URLPath == administration/memberAdd %>active<% end_if %>"><a href="administration/memberAdd"><%t AdminMenu.ADDMEMBER "AdminMenu.ADDMEMBER" %></a></li>
                            </ul>
                        </li>
                        <% end_if %>
                    </ul>
                    <% end_if %>
                </div><!--/.navbar-collapse -->
            </div>
        </nav>

        $Layout

        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bottom-navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <p class="navbar-text navbar-left">&copy; 2015</p>
                </div>
            </div>
        </nav>
    </body>
</html>