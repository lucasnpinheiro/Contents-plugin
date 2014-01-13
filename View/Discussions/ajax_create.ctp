<?php 
if($saved):
    echo $this->request->data['Content']['body'];
else:
    echo $this->Form->create(
        'Content', 
        array(
            'id'=>'NewCommentForm',
            'url'=>$this->here,
            'role'=>'form',
            'class'=>'well well-sm',
            'method'=>'POST',
            'inputDefaults'=>array(
                'div'=>array(
                    'class'=>'form-group'
                ),
                'class'=>'form-control',
                'required'=>false
            )
        )
    );

    echo $this->Form->input(
        'body',
        array(
            'label'=>'Comment',
            'type'=>'textarea'
        )
    );

    echo $this->Form->input(
        'model',
        array(
            'type'=>'hidden'
        )
    );


    echo $this->Form->input(
        'model_id',
        array(
            'type'=>'hidden'
        )
    );

    echo $this->Form->input(
        'content_status',
        array(
            'type'=>'hidden',
            'value'=>'published'
        )
    );


    echo $this->Form->input(
        'content_type',
        array(
            'type'=>'hidden',
            'value'=>'discussion'
        )
    );

    echo $this->Form->submit(
         __d('contents', 'Submit'), 
         array(
             'div'=>array(
                'class'=>'form-group',
                'data-ajaxifiable'=>"true",
                'data-ajaxifiable-target'=>$modelId,
             ),
             'class'=>'btn btn-primary'
         )
     ); 

    echo $this->Form->end();
endif;