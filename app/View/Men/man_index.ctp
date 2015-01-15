<div class="row">
        <div class="col-sm-12">
          <p class="upgrade_member">You are a Free Member as of now. <a href="">Upgrade</a></p>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-12 ">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4 class="panel-title">What's New !</h4>
            </div>
            <div class="panel-body">
              <div class="dasbord_whats_new">
                <table class="table table-responsive  table-bordered ">
                  <tr>
                    <td class="">Vartual Gifts <a href="" class="button_new right">New</a></td>
                    <td><a href="" class="button_new">New</a> View (10)</td>
                    <td><a href="" class="button_new">All</a> View (10)</td>
                    <td class="delete_button"><a href=""><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <tr>
                    <td class="">Chat Invitations <a href="" class="button_new right">New</a></td>
                    <td><a href="" class="button_new">New</a> View (5)</td>
                    <td><a href="" class="button_new">All</a> View (6)</td>
                    <td class="delete_button"><a href=""><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <tr>
                    <td class="">Romance Cards <a href="" class="button_new right">New</a></td>
                    <td><a href="" class="button_new">New</a> View (3)</td>
                    <td><a href="" class="button_new">All</a> View (8)</td>
                    <td class="delete_button"><a href=""><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <tr>
                    <td class="">Love Melody <a href="" class="button_new right">New</a></td>
                    <td>&nbsp;</td>
                    <td><a href="" class="button_new">All</a> View (4)</td>
                    <td class="delete_button"><a href=""><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <tr>
                    <td class="">Mails <a href="" class="button_new right">New</a></td>
                    <td>&nbsp;</td>
                    <td><a href="" class="button_new">All</a> View (4)</td>
                    <td class="delete_button"><a href=""><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <tr>
                    <td class="">Favorite <a href="" class="button_new right">New</a></td>
                    <td>&nbsp;</td>
                    <td><a href="" class="button_new">All</a> View (4)</td>
                    <td class="delete_button"><a href=""><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 ">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4 class="panel-title">Chat Invitation New
                <div class="pagenations"><a href=""><i class="fa fa-chevron-left"></i></a> <a href=""><i class="fa fa-chevron-right"></i></a></div>
              </h4>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="new_chat_invitation">
                  <ul>
                    <li>You recived a new chat invite from Susane! <a href="">View</a></li>
                    <li>You recived a new chat invite from Susane! <a href="">View</a></li>
                    <li>You recived a new chat invite from Susane! <a href="">View</a></li>
                    <li>You recived a new chat invite from Susane! <a href="">View</a></li>
                    <li>You recived a new chat invite from Susane! <a href="">View</a></li>
                    <li>You recived a new chat invite from Susane! <a href="">View</a></li>
                    <li>You recived a new chat invite from Susane! <a href="">View</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
          <div class="panel panel-info inviting-chat">
            <div class="panel-heading">
              <h4 class="panel-title text-center">These Men are inviting you to Chat !</h4>
            </div>
            <div class="panel-body">
               <?php 
					if(isset($this->params['prefix']) && $this->params['prefix'] == 'woman'){  
						echo $this->element('front/men_invite_sidebar');
					}else if(isset($this->params['prefix']) && $this->params['prefix'] == 'man'){  
						echo $this->element('front/women_invite_sidebar');
					}						
				?>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="user_icon_links">
            <table  border="0" cellspacing="0" cellpadding="0"  class="table table-responsive  table-bordered">
            <thead>
              <tr>
                <th>Chat Now</th>
                <th>Shedule a Date</th>
                <th>Webcan is On</th>
                <th>Webcan is Off</th>
                <th>Send an Email</th>
                <th>Send a Gift</th>
                <th>Add to Favorites</th>
                <th>Send Card</th>
                <th>Shedule Chat</th>
                <th>Play an Intro Video</th>
                <th>Send Love Melody</th>
                <th>Request Contact Info</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-comment"></i></a></td>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-calendar-o"></i></a></td>
                <td align="center" valign="bottom" class="webcam_on"><a href=""><i class="fa fa-camera"></i></a></td>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-camera"></i></a></td>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-envelope"></i></a></td>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-gift"></i></a></td>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-heart"></i></a></td>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-file-image-o"></i></a></td>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-weixin"></i></a></td>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-video-camera"></i></a></td>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-music"></i></a></td>
                <td align="center" valign="bottom"><a href=""><i class="fa fa-phone"></i></a></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
 
