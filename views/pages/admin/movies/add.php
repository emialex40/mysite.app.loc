<?php
/**
 * @var \App\Kernel\View\View $view
 */

$view->component('start');

?>

<h1>Add movie page</h1>

<form action="/admin/movies/add" method="post">
    <p>Name</p>
    <div>
        <input type="text" name="name" id="">
    </div>
    <div>
        <button>Add</button>
    </div>
</form>

<?php $view->component('end'); ?>
