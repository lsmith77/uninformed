<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $organisation->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $organisation->getName() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $organisation->getSlug() ?></td>
    </tr>
    <tr>
      <th>Parent:</th>
      <td><?php echo $organisation->getParentId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $organisation->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $organisation->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Author:</th>
      <td><?php echo $organisation->getAuthorId() ?></td>
    </tr>
    <tr>
      <th>Version:</th>
      <td><?php echo $organisation->getVersion() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('organisation/edit?id='.$organisation->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('organisation/index') ?>">List</a>
