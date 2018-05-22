<ul class="right">
    
    <?php 
    
    
    
        if($navigation_right){
            foreach($navigation_right as $nav){
                
                
                if($nav['label'] && !empty($nav['label'])){
                    echo is_array($nav['has_dropdown']) ? '<li class="has-dropdown">' : '<li>';
                    echo $this->Html->link(__($nav['label']), $nav['url'], $nav['options']);
                    
                    if(is_array($nav['has_dropdown']))
                    {
                        echo '<ul class="dropdown">';
                        foreach($nav['has_dropdown'] as $sub_nav){
                            echo '<li>';
                            echo $this->Html->link(__($sub_nav['label']), $sub_nav['url'], $sub_nav['options']);
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                }else{
                    echo '<li class="divider">';
                }
                echo '</li>';
            }
        }

    
    ?>
</ul>
