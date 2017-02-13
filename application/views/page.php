<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>分页</title>
</head>
<body>

    <th><td >id  </td><td>type </td><td>title  </td><td>media_id  </td></th><br>
    <?php foreach ($data as $v): ?>
        <th><td><?php echo $v['id']?></td> <td><?php echo $v['type']?></td> <td><?php echo $v['title']?></td> <td><?php echo $v['media_id']?></td><td><?php echo anchor('media/delete/'.$v['id'], '删 除');?></td></th><br/>
    <?php endforeach; ?>

<div id="pagelist">
    <ul><?php  echo $this->pagination->create_links();?>
    </ul>
</div>
    <?php echo anchor('media/select', 'Click Here');?>
</body>
</html>