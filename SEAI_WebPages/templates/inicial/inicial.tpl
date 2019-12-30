{include file='../common/header.tpl'}
{include file='../common/login_form.tpl'}

<!                                MAIN TEXT                                    >
  <div class="page-content p-5" id="content">
    <h2 class="display-4 text-white">SEAI- WEB PAGE</h2>
    <p class="lead text-white mb-0">Project conceived in the ambit of the unit course of Engineering Systems
     - Automation and Instrumentation carried out by students of the 5th year of the Integrated
     Master in Electrical and Computer Engineering of the Faculty of Engineering, University of Porto.</p>
    <div class="separator"></div>
    {if (isset($success_messages))}
      {foreach $success_messages as $success}
        <div class="msg_success">{$success} <a class="msg_close" href="#"  style="text-decoration:none;">&#215;</a></div>
      {/foreach}
    {/if}
    {if (isset($error_messages))}
      {foreach $error_messages as $error}
        <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$error}</div>
      {/foreach}
    {/if}
    <div class="row text-white">
      <div class="col-lg-6">
        <p class="lead">The future of maritime operations, particularly with unmanned vehicles,
          involves sophisticated web-based execution control and planning systems.
          For this reason, the system communicates with a web-based platform (Ripples) developed by the
          <a class="one"  href="https://lsts.fe.up.pt/" target="_blank"><b> Underwater Systems and Technology Laboratory
          </b></a> in order to control and monitor the existing fleet of vehicules and consists in the centralization of all
          the information acquired from this type of vehicle with a main focus on the planning of new missions of said vehicules.
          To access this information, the user must register as a Service Provider or a Service Client.
        </p>
        <p class="lead"> All the data present in the platform is managed by the users that acquired it - Service Providers.</p>
        <p class="lead">Regarding the requests for new mission plans or access to past data, these actions are preformed by the Service Client.</p>
        <p class="lead"> For more information on how to login in the website, check the following videos.</p>
      </div>
      <div class="col-lg-6">
        <p class="lead text-white mb-0"> Registering as Service Provider</p>
        <div class="modal-body"  align="center">
          <iframe width="70%" height="200" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
        </div>
        <!--<p class="lead font-italic mb-0 text-muted"> Put video on how to register and navigate through the site</p>-->

        <p class="lead text-white mb-0"> Registering as Service Client</p>
          <div class="modal-body"  align="center">
            <iframe width="70%" height="200" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
          </div>
        <!--<p class="lead font-italic mb-0 text-muted"> Put video on how to register and navigate through the site</p>-->
      </div>
    </div>

  </div>

{include file='../inicial/slideshow.tpl'}
{include file='../common/footer.tpl'}
{*include file='../common/footer-short.tpl'*}
