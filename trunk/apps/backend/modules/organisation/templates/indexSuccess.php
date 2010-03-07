<h1>Organisations List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Slug</th>
      <th>Parent</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Author</th>
      <th>Version</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($organisations as $organisation): ?>
    <tr>
      <td><a href="<?php echo url_for('organisation/show?id='.$organisation->getId()) ?>"><?php echo $organisation->getId() ?></a></td>
      <td><?php echo $organisation->getName() ?></td>
      <td><?php echo $organisation->getSlug() ?></td>
      <td><?php echo $organisation->getParentId() ?></td>
      <td><?php echo $organisation->getCreatedAt() ?></td>
      <td><?php echo $organisation->getUpdatedAt() ?></td>
      <td><?php echo $organisation->getAuthorId() ?></td>
      <td><?php echo $organisation->getVersion() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('organisation/new') ?>">New</a>
