<h1>Excel files List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>File</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Author</th>
      <th>Version</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($excel_files as $excel_file): ?>
    <tr>
      <td><a href="<?php echo url_for('excelfiles/show?id='.$excel_file->getId()) ?>"><?php echo $excel_file->getId() ?></a></td>
      <td><?php echo $excel_file->getName() ?></td>
      <td><?php echo $excel_file->getFile() ?></td>
      <td><?php echo $excel_file->getCreatedAt() ?></td>
      <td><?php echo $excel_file->getUpdatedAt() ?></td>
      <td><?php echo $excel_file->getAuthorId() ?></td>
      <td><?php echo $excel_file->getVersion() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('excelfiles/new') ?>">New</a>
