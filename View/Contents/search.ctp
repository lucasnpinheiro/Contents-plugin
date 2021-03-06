<?php
echo $this->Form->create(
    'Content', 
    array(
        'url' => $this->here,
        'role'=>'form',
        'class'=>'form-inline',
        'inputDefaults'=>array(
            'div'=>array(
                'class'=>'form-group'
            ),
            'class'=>'form-control',
            'required'=>false
        )
    )
);
/*
echo $this->Form->input('title');
echo $this->Form->input('body');
*/
echo $this->Form->input('q', array('type'=>'search', 'label'=>array('class'=>'sr-only')));
echo $this->Form->submit(__('Search'), array('class'=>'btn btn-default', 'div'=>false));
echo $this->Form->end();
?>

<?php foreach ($contents as $content): ?>
<div class="well well-sm well-result">
    <strong>
        <?php 
            echo $this->Html->link(
                $content['Content']['title'], 
                array(
                    'plugin'=>'contents',
                    'controller'=>"{$content['Content']['content_type']}s",
                    'action'=>'view',
                    $content['Content']['slug']
                )
            );
        ?>
    </strong>
    <?php 
        echo $this->Html->tag(
            'strong',    
            Inflector::humanize($content['Content']['content_type']),
            array(
                'class'=>'text-muted'
            )
        ); 
    ?>
    <div class="text-muted">
        <em>
            <strong>Posted On:</strong>
            <?php echo date('m/d/y', strtotime($content['Content']['created'])); ?>
        </em>
    </div>
    <div>
		<?php 
			echo $this->Text->truncate(
				$content['Content']['body'], 
				'300', 
				array(
					'html'=>true, 
					'exact'=>false
				)
			); 
		?>
	</div>
</div>
<?php endforeach; ?>

<?php echo $this->element('pager'); ?>