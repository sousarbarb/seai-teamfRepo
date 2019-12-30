{include file='common/header.tpl'}
{include file='common/navbar_logged_in.tpl'}
{include file='common/logout.tpl'}

<div class="menusLogin p-5">
<div class="vehicle_text">


	<h2 class="display-4 text-white">{$entity_info['entity_name']}</h2>
	<p class="lead text-white mb-0">Information about entity</p>
	<div class="separator">
	</div>

	<article>
		<p>E-mail {$entity_info['entity_email']}</p>
    <p>Phone number {$entity_info['entity_phonenumber']}</p>
		<p>Address {$entity_info['entity_address']}</p>

    <div class="path"><img height="100px" width="115px" src="{$BASE_URL}{$entity_info['entity_logopath']}"></img></div> 

	</article>	

  <br>

	<article>
		<p>Official Representative {$entity_info['repres_name']}</p>
		<p>E-mail {$entity_info['repres_email']}</p>
    <p>Phone number {$entity_info['repres_phonenumber']}</p>
	</article>


</div>
</div>

{include file='common/footer-short.tpl'}