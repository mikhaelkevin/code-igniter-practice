<h2>Edit Form</h2>

<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>

<form action="/news/edit/<?= $id ?>" method="POST">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label for="title">Title</label>
    <input type="input" name="title" value="<?= $title ?>">
    
    <br/>

    <label for="body">Text</label>
    <textarea name="body" cols="45" rows="4"><?= $body ?></textarea>

    <br/>

    <button type="submit">Save</button>
</form>