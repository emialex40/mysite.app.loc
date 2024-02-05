<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Session\Session $session
 */

$view->component('start');

?>

<h1>Add movie page</h1>

<form action="/admin/movies/add" method="post">
    <p>Name</p>
    <div>
        <input type="text" name="name" id="">
    </div>
    <?php if ($session->has('name')) : ?>
    <ul>
        <?php foreach ($session->getFlash('name') as $error) : ?>
        <li style="color: red;"><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <div>
        <button>Add</button>
    </div>
</form>

<?php $view->component('end'); ?>
