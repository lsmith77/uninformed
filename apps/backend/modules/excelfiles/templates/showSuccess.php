<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $excel_file->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $excel_file->getName() ?></td>
    </tr>
    <tr>
      <th>File:</th>
      <td><?php echo $excel_file->getFile() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $excel_file->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $excel_file->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Author:</th>
      <td><?php echo $excel_file->getAuthorId() ?></td>
    </tr>
    <tr>
      <th>Version:</th>
      <td><?php echo $excel_file->getVersion() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('excelfiles/edit?id='.$excel_file->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('excelfiles/index') ?>">List</a>
