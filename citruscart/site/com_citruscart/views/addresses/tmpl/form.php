<?php 
/*------------------------------------------------------------------------
# com_citruscart - citruscart
# ------------------------------------------------------------------------
# author    Citruscart Team - Citruscart http://www.citruscart.com
# copyright Copyright (C) 2012 Citruscart.com All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://citruscart.com
# Technical Support:  Forum - http://citruscart.com/forum/index.html
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('script', 'citruscart.js', 'media/citruscart/js/'); ?>
<?php $form = $this->form; ?>
<?php $row = $this->row; ?>
<?php $tmpl = $this->tmpl; ?>
<?php JFilterOutput::objectHTMLSafe( $row ); ?>

<div class='componentheading'>
    <span><?php echo JText::_('COM_CITRUSCART_EDIT_ADDRESS'); ?></span>
</div>

<form action="<?php echo JRoute::_( $form['action'].$tmpl ) ?>" onsubmit="CitruscartFormValidation( '<?php echo $form['validation']; ?>', 'validationmessage', document.adminForm.task.value, document.adminForm )" method="post" class="adminform" name="adminForm" enctype="multipart/form-data" >
    <div style="float: right;">
        <input type="button" onclick="CitruscartSubmitForm('save');" value="<?php echo JText::_('COM_CITRUSCART_SUBMIT'); ?>" />    
    </div>

    <?php
    echo "<< <a href='".JRoute::_("index.php?option=com_citruscart&view=addresses".$tmpl)."'>".JText::_('COM_CITRUSCART_CANCEL_AND_RETURN_TO_LIST')."</a>";
    ?>
    
    <div id="validationmessage"></div>
	<?php echo $this->form_inner; ?>
    <input type="button" onclick="CitruscartSubmitForm('save');" value="<?php echo JText::_('COM_CITRUSCART_SUBMIT'); ?>" />

    <input type="hidden" name="id" value="<?php echo $row->address_id; ?>" />
    <input type="hidden" name="task" id="task" value="" />

    <?php echo $form['validate']; ?>

</form>
