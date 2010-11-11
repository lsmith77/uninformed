<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $country->getId() ?></td>
    </tr>
    <tr>
      <th>Iso:</th>
      <td><?php echo $country->getIso() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $country->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $country->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $country->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Author:</th>
      <td><?php echo $country->getAuthorId() ?></td>
    </tr>
    <tr>
      <th>Version:</th>
      <td><?php echo $country->getVersion() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('country/edit?id='.$country->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('country/index') ?>">List</a>
