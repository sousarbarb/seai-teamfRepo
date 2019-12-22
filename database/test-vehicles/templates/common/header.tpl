<!DOCTYPE html>
<html>

<head>
  <title>test-vehicles</title>
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Stylesheet of the website -->
  <link rel="stylesheet" href="{$BASE_URL}css/style.css">
  <!-- Addition of jquery lib to our project -->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <!-- Addition of our javascript main file -->
  <script src="{$BASE_URL}javascript/main.js"></script>
</head>

<body>

<header>
  <!-- Website title -->
  <header>SEAI TEAM F - Test of tables related with vehicles</header>
  <!-- Success and Error Mesages -->
  <section>
    {if isset($ERROR_MESSAGES)}
      {foreach $ERROR_MESSAGES as $error}
        <article class="error">{$error} <a class="close" href="#">&#215;</a></article>
      {/foreach}
    {/if}
    {if isset($SUCCESS_MESSAGES)}
      {foreach $SUCCESS_MESSAGES as $success}
        <article class="success">{$success} <a class="close" href="#">&#215;</a></article>
      {/foreach}
    {/if}
  </section>
  <!-- Top Navigation Bar -->
  <nav>
    <!-- Create new vehicles, sensors, etc -->
    {if $PAGE == 'new'} <a href="{$BASE_URL}pages/create.php" class="active">New</a>
    {else}              <a href="{$BASE_URL}pages/create.php">New</a>{/if}
    <!-- Search vehicles, sensors, etc -->
    {if $PAGE == 'search'}  <a href="{$BASE_URL}pages/search.php" class="active">Search</a>
    {else}                  <a href="{$BASE_URL}pages/search.php">Search</a>{/if}
    <!-- Delete vehicles, sensors, etc -->
    {if $PAGE == 'delete'}  <a href="{$BASE_URL}pages/delete.php" class="active">Delete</a>
    {else}                  <a href="{$BASE_URL}pages/delete.php">Delete</a>{/if}
  </nav>
</header>