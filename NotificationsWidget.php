<?php

namespace gudezi\notifications;

/**
 * This is just an example.
 */
class NotificationsWidget extends \yii\base\Widget
{
    const TYPE_MESSAGE = 1;
    const TYPE_ALERT = 2;
    const TYPE_TASK = 3;
    const TYPE_FLAG = 4;
    
    public $options;
    public $items;
    public $type = self::TYPE_MESSAGE;
    public $directoryAsset;

    private $cantidad;
    
    public function run()
    {
        //return "Hello!";
        
        if ($this->items=='') 
            $this->items=array();
        
        $this->cantidad = count($this->items);
        if ($this->cantidad==0) 
            $this->cantidad='';
        
        return $this->generate($this->type);
    }
    
    private function generate($type)
    {
        $head = $foot = '';
        
        switch ($type) {
            case self::TYPE_MESSAGE:
                $button = '<li class="dropdown messages-menu"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">'.$this->cantidad.'</span>
                    </a>';
                
                if($this->cantidad>0)
                {
                    if($this->cantidad>1)
                        $head='<ul class="dropdown-menu"><li class="header">Usted tiene '.$this->cantidad.' mensajes nuevos</li>';
                    else
                        $head='<ul class="dropdown-menu"><li class="header">Usted tiene 1 mensaje nuevo</li>';
                    
                    $messages = $this->display_mensajes($this->items);
                    
                    $foot = '</ul></li>';
                }
                break;
            case self::TYPE_ALERT:
                $button = '<li class="dropdown notifications-menu"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o faa-ring animated faa-slow"></i>
                        <span class="label label-danger">'.$this->cantidad.'</span>
                    </a>';
                
                if($this->cantidad>0)
                {
                    if($this->cantidad>1)
                        $head='<ul class="dropdown-menu"><li class="header">Usted tiene '.$this->cantidad.' notificaciones</li>';
                    else
                        $head='<ul class="dropdown-menu"><li class="header">Usted tiene 1 notificacion</li>';
                    
                    $messages = $this->display_alerts($this->items);
                    
                    $foot = '</ul></li>';
                }               
                break;
            case self::TYPE_TASK:
                $button = '<li class="dropdown tasks-menu"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">'.$this->cantidad.'</span>
                    </a>';
                
                if($this->cantidad>0)
                {
                    if($this->cantidad>1)
                        $head='<ul class="dropdown-menu"><li class="header">Usted tiene '.$this->cantidad.' tareas</li>';
                    else
                        $head='<ul class="dropdown-menu"><li class="header">Usted tiene 1 tarea</li>';
                    
                    $messages = $this->display_tasks($this->items);
                    
                    $foot = '</ul></li>';
                }
                break;
            case self::TYPE_FLAG:
                $button = '<li class="dropdown notifications-menu"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag" aria-hidden="true"></i> <span class="hidden-xs">CASTELAR</span>
                    </a>';
                
                if($this->cantidad>0)
                {
                    $head='<ul class="dropdown-menu"><li class="header"><b>Sectores</b></li>';
                    
                    $messages = $this->display_flag($this->items);
                    
                    $foot = '</ul></li>';
                }
                break;
        }
        
        
        return $button.$head.$messages.$foot;
    }

    private function display_mensajes($items)
    {
        $message = '<li><ul class="menu">';
        
        foreach($items as $item)
        {
            $message .= '<li>';
            if($item['url']!='')
                $message .= '<a href="'.$item['url'].'">';
            else
                $message .= '<a href="#">';
            
            if($item['image']!='')
                $message .= '<div class="pull-left"><img src="'.$item['image'].'" class="img-circle" alt="User Image">';
            else
                $message .= '<div class="pull-left"><img src="'.$this->directoryAsset.'/img/user2-160x160.jpg" class="img-circle" alt="User Image">';
                    
            $message .= '</div><h4>'.$item['user'].'<small><i class="fa fa-clock-o"></i> '.$item['time'].'</small></h4>';
            
            $message .= '<p>'.$item['message'].'</p></a></li>';
        }
        
        $message .= '</ul></li><li class="footer"><a href="#">Ver todos los mensajes</a></li>';
        
        return $message;
    }
    
    private function display_alerts($items)
    {
        $message = '<li><ul class="menu">';
        
        foreach($items as $item)
        {
            $message .= '<li>';

            if($item['url']!='')
                $message .= '<a href="'.$item['url'].'">';
            else
                $message .= '<a href="#">';
            
            if($item['image']!='')
                $message .= '<i class="fa fa-'.$item['image'].' text-aqua"></i>';
            else
                $message .= '<i class="fa fa-user text-aqua"></i>';
            
            $message .= $item['message'].'</a></li>';
        }
        
        $message .= '</ul></li><li class="footer"><a href="#">Ver todas</a></li>';

        return $message;
    }

    private function display_tasks($items)
    {
        $message = '<li><ul class="menu">';
        
        foreach($items as $item)
        {
            $message .= '<li>';

            if($item['url']!='')
                $message .= '<a href="'.$item['url'].'">';
            else
                $message .= '<a href="#">';
            
            $message .= '<h3>'.$item['message'].'<small class="pull-right">'.$item['time'].'%</small></h3>';

            $message .= '<div class="progress xs">
              <div class="progress-bar progress-bar-aqua" style="width: '.$item['time'].'%" role="progressbar" 
              aria-valuenow="'.$item['time'].'" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only">'.$item['time'].'% comepleto</span></div></div>';

            $message .= '</a></li>';
        }
        
        $message .= '</ul></li><li class="footer"><a href="#">Ver todas las tareas</a></li>';

        return $message;
    }
    
    private function display_flag($items)
    {
        $message = '<li><ul class="menu">';
        
        foreach($items as $item)
        {
            $message .= '<li>';

            if($item['url']!='')
                $message .= '<a href="'.$item['url'].'">';
            else
                $message .= '<a href="#">';
            
            if($item['image']!='')
                $message .= '<i class="fa fa-'.$item['image'].'"></i>';
            else
                $message .= '<i class="fa fa-flag"></i>';

            $message .= $item['message'];
            $message .= '</a></li>';
        }
        
        $message .= '</ul></li><li class="footer"><a href="#">Administrar</a></li>';

        return $message;
    }

}
