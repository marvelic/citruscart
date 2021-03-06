<?php
/*------------------------------------------------------------------------
# com_citruscart
# ------------------------------------------------------------------------
# author   Citruscart Team  - Citruscart http://www.citruscart.com
# copyright Copyright (C) 2014 Citruscart.com All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://citruscart.com
# Technical Support:  Forum - http://citruscart.com/forum/index.html
-------------------------------------------------------------------------*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

class CitruscartControllerProductComments extends CitruscartController
{
	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();

		$this->set('suffix', 'productcomments');
		$this->registerTask( 'productcomment_enabled.enable', 'boolean' );
		$this->registerTask( 'productcomment_enabled.disable', 'boolean' );

	}
	/**
	 *
	 */
	function _setModelState()
	{
		$state = parent::_setModelState();
		$app = JFactory::getApplication();
		$ns = $this->getNamespace();
		$model = $this->getModel( $this->get('suffix') );

        $state['order']     = $app->getUserStateFromRequest($ns.'.filter_order', 'filter_order', 'tbl.created_date', 'cmd');
        $state['direction'] = $app->getUserStateFromRequest($ns.'.filter_direction', 'filter_direction', 'DESC', 'word');
		$state['filter_id_from'] 	= $app->getUserStateFromRequest($ns.'id_from', 'filter_id_from', '', '');
    	$state['filter_id_to'] 		= $app->getUserStateFromRequest($ns.'id_to', 'filter_id_to', '', '');
    	$state['filter_name'] 		= $app->getUserStateFromRequest($ns.'name', 'filter_name', '', '');
		$state['filter_enabled'] 	= $app->getUserStateFromRequest($ns.'filter_enabled', 'filter_enabled', '', '');
		$state['filter_reported']   = $app->getUserStateFromRequest($ns.'filter_reported', 'filter_reported', '', '');

		foreach ($state as $key=>$value)
		{
			$model->setState( $key, $value );
		}
		return $state;
	}
	
	/**
	 *
	 */
	function save()
	{
		
		$app = JFactory::getApplication();
		
		$model 	= $this->getModel( $this->get('suffix') );
				
		$view = $app->input->getString('view');
		
		$row = JTable::getInstance($view,'CitruscartTable');
	
		$row->load( $model->getId() );
	        
	    $row->bind( $app->input->getArray($_POST) );	   	
	    
	    $row->user_name =$app->input->getString( 'user_id_name_hidden' );

	   if ( $row->save() )
		{
			$model->setId( $row->id );
			$model->clearCache();
			$this->messagetype 	= 'message';
			$this->message  	= JText::_('COM_CITRUSCART_SAVED');
		}
		else
		{
			$this->messagetype 	= 'notice';
			$this->message 		= JText::_('COM_CITRUSCART_SAVE_FAILED')." - ".$row->getError();
		}
		$redirect = "index.php?option=com_citruscart";
   		 $task = $app->input->getString( 'task' );
    	switch ($task)
    	{
    		case "savenew":
    			$redirect .= '&view='.$this->get('suffix').'&task=add';
    		  break;
    		case "apply":
    			$redirect .= '&view='.$this->get('suffix').'&task=edit&id='.$model->getId();
    		  break;
    		case "save":
    		default:
    			$redirect .= "&view=".$this->get('suffix');
    		  break;
    	}

    	$redirect = JRoute::_( $redirect, false );
		$this->setRedirect( $redirect, $this->message, $this->messagetype );
	}
}
