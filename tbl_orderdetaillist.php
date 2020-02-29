<?php
namespace PHPMaker2019\asgbn_wh;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tbl_orderdetail_list = new tbl_orderdetail_list();

// Run the page
$tbl_orderdetail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_orderdetail_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_orderdetail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_orderdetaillist = currentForm = new ew.Form("ftbl_orderdetaillist", "list");
ftbl_orderdetaillist.formKeyCountName = '<?php echo $tbl_orderdetail_list->FormKeyCountName ?>';

// Validate form
ftbl_orderdetaillist.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($tbl_orderdetail_list->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderdetail->Code->caption(), $tbl_orderdetail->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_orderdetail_list->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_orderdetail->PCS->caption(), $tbl_orderdetail->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_orderdetail->PCS->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_orderdetaillist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_orderdetaillist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_orderdetaillist.lists["x_Code"] = <?php echo $tbl_orderdetail_list->Code->Lookup->toClientList() ?>;
ftbl_orderdetaillist.lists["x_Code"].options = <?php echo JsonEncode($tbl_orderdetail_list->Code->lookupOptions()) ?>;
ftbl_orderdetaillist.autoSuggests["x_Code"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script src="phpjs/ewpreview.js"></script>
<script>
ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
ew.PREVIEW_SINGLE_ROW = false;
ew.PREVIEW_OVERLAY = false;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tbl_orderdetail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_orderdetail_list->TotalRecs > 0 && $tbl_orderdetail_list->ExportOptions->visible()) { ?>
<?php $tbl_orderdetail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_orderdetail_list->ImportOptions->visible()) { ?>
<?php $tbl_orderdetail_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$tbl_orderdetail->isExport() || EXPORT_MASTER_RECORD && $tbl_orderdetail->isExport("print")) { ?>
<?php
if ($tbl_orderdetail_list->DbMasterFilter <> "" && $tbl_orderdetail->getCurrentMasterTable() == "tbl_order") {
	if ($tbl_orderdetail_list->MasterRecordExists) {
		include_once "tbl_ordermaster.php";
	}
}
?>
<?php } ?>
<?php
$tbl_orderdetail_list->renderOtherOptions();
?>
<?php $tbl_orderdetail_list->showPageHeader(); ?>
<?php
$tbl_orderdetail_list->showMessage();
?>
<?php if ($tbl_orderdetail_list->TotalRecs > 0 || $tbl_orderdetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_orderdetail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_orderdetail">
<?php if (!$tbl_orderdetail->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_orderdetail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_orderdetail_list->Pager)) $tbl_orderdetail_list->Pager = new PrevNextPager($tbl_orderdetail_list->StartRec, $tbl_orderdetail_list->DisplayRecs, $tbl_orderdetail_list->TotalRecs, $tbl_orderdetail_list->AutoHidePager) ?>
<?php if ($tbl_orderdetail_list->Pager->RecordCount > 0 && $tbl_orderdetail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_orderdetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_orderdetail_list->pageUrl() ?>start=<?php echo $tbl_orderdetail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_orderdetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_orderdetail_list->pageUrl() ?>start=<?php echo $tbl_orderdetail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_orderdetail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_orderdetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_orderdetail_list->pageUrl() ?>start=<?php echo $tbl_orderdetail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_orderdetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_orderdetail_list->pageUrl() ?>start=<?php echo $tbl_orderdetail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_orderdetail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_orderdetail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_orderdetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_orderdetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_orderdetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_orderdetail_list->TotalRecs > 0 && (!$tbl_orderdetail_list->AutoHidePageSizeSelector || $tbl_orderdetail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_orderdetail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_orderdetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_orderdetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_orderdetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_orderdetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_orderdetail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_orderdetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_orderdetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_orderdetaillist" id="ftbl_orderdetaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_orderdetail_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_orderdetail_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_orderdetail">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($tbl_orderdetail->getCurrentMasterTable() == "tbl_order" && $tbl_orderdetail->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="tbl_order">
<input type="hidden" name="fk_ID_Order" value="<?php echo $tbl_orderdetail->ID_Order->getSessionValue() ?>">
<?php } ?>
<div id="gmp_tbl_orderdetail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_orderdetail_list->TotalRecs > 0 || $tbl_orderdetail->isAdd() || $tbl_orderdetail->isCopy() || $tbl_orderdetail->isGridEdit()) { ?>
<table id="tbl_tbl_orderdetaillist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_orderdetail_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_orderdetail_list->renderListOptions();

// Render list options (header, left)
$tbl_orderdetail_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_orderdetail->Code->Visible) { // Code ?>
	<?php if ($tbl_orderdetail->sortUrl($tbl_orderdetail->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_orderdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderdetail_Code" class="tbl_orderdetail_Code"><div class="ew-table-header-caption"><?php echo $tbl_orderdetail->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_orderdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderdetail->SortUrl($tbl_orderdetail->Code) ?>',2);"><div id="elh_tbl_orderdetail_Code" class="tbl_orderdetail_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderdetail->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderdetail->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderdetail->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderdetail->PCS->Visible) { // PCS ?>
	<?php if ($tbl_orderdetail->sortUrl($tbl_orderdetail->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $tbl_orderdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_orderdetail_PCS" class="tbl_orderdetail_PCS"><div class="ew-table-header-caption"><?php echo $tbl_orderdetail->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $tbl_orderdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_orderdetail->SortUrl($tbl_orderdetail->PCS) ?>',2);"><div id="elh_tbl_orderdetail_PCS" class="tbl_orderdetail_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_orderdetail->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_orderdetail->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_orderdetail->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_orderdetail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($tbl_orderdetail->isAdd() || $tbl_orderdetail->isCopy()) {
		$tbl_orderdetail_list->RowIndex = 0;
		$tbl_orderdetail_list->KeyCount = $tbl_orderdetail_list->RowIndex;
		if ($tbl_orderdetail->isAdd())
			$tbl_orderdetail_list->loadRowValues();
		if ($tbl_orderdetail->EventCancelled) // Insert failed
			$tbl_orderdetail_list->restoreFormValues(); // Restore form values

		// Set row properties
		$tbl_orderdetail->resetAttributes();
		$tbl_orderdetail->RowAttrs = array_merge($tbl_orderdetail->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_tbl_orderdetail', 'data-rowtype'=>ROWTYPE_ADD));
		$tbl_orderdetail->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_orderdetail_list->renderRow();

		// Render list options
		$tbl_orderdetail_list->renderListOptions();
		$tbl_orderdetail_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_orderdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_orderdetail_list->ListOptions->render("body", "left", $tbl_orderdetail_list->RowCnt);
?>
	<?php if ($tbl_orderdetail->Code->Visible) { // Code ?>
		<td data-name="Code">
<span id="el<?php echo $tbl_orderdetail_list->RowCnt ?>_tbl_orderdetail_Code" class="form-group tbl_orderdetail_Code">
<?php
$wrkonchange = "ew.autoFill(this);" . trim(@$tbl_orderdetail->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_orderdetail->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_orderdetail_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" id="sv_x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" value="<?php echo RemoveHtml($tbl_orderdetail->Code->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>"<?php echo $tbl_orderdetail->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" data-value-separator="<?php echo $tbl_orderdetail->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" id="x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_orderdetaillist.createAutoSuggest({"id":"x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code","forceSelect":true});
</script>
<?php echo $tbl_orderdetail->Code->Lookup->getParamTag("p_x" . $tbl_orderdetail_list->RowIndex . "_Code") ?>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" name="o<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" id="o<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_orderdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS">
<span id="el<?php echo $tbl_orderdetail_list->RowCnt ?>_tbl_orderdetail_PCS" class="form-group tbl_orderdetail_PCS">
<input type="text" data-table="tbl_orderdetail" data-field="x_PCS" name="x<?php echo $tbl_orderdetail_list->RowIndex ?>_PCS" id="x<?php echo $tbl_orderdetail_list->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_orderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_orderdetail->PCS->EditValue ?>"<?php echo $tbl_orderdetail->PCS->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_PCS" name="o<?php echo $tbl_orderdetail_list->RowIndex ?>_PCS" id="o<?php echo $tbl_orderdetail_list->RowIndex ?>_PCS" value="<?php echo HtmlEncode($tbl_orderdetail->PCS->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_orderdetail_list->ListOptions->render("body", "right", $tbl_orderdetail_list->RowCnt);
?>
<script>
ftbl_orderdetaillist.updateLists(<?php echo $tbl_orderdetail_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($tbl_orderdetail->ExportAll && $tbl_orderdetail->isExport()) {
	$tbl_orderdetail_list->StopRec = $tbl_orderdetail_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_orderdetail_list->TotalRecs > $tbl_orderdetail_list->StartRec + $tbl_orderdetail_list->DisplayRecs - 1)
		$tbl_orderdetail_list->StopRec = $tbl_orderdetail_list->StartRec + $tbl_orderdetail_list->DisplayRecs - 1;
	else
		$tbl_orderdetail_list->StopRec = $tbl_orderdetail_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_orderdetail_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_orderdetail_list->FormKeyCountName) && ($tbl_orderdetail->isGridAdd() || $tbl_orderdetail->isGridEdit() || $tbl_orderdetail->isConfirm())) {
		$tbl_orderdetail_list->KeyCount = $CurrentForm->getValue($tbl_orderdetail_list->FormKeyCountName);
		$tbl_orderdetail_list->StopRec = $tbl_orderdetail_list->StartRec + $tbl_orderdetail_list->KeyCount - 1;
	}
}
$tbl_orderdetail_list->RecCnt = $tbl_orderdetail_list->StartRec - 1;
if ($tbl_orderdetail_list->Recordset && !$tbl_orderdetail_list->Recordset->EOF) {
	$tbl_orderdetail_list->Recordset->moveFirst();
	$selectLimit = $tbl_orderdetail_list->UseSelectLimit;
	if (!$selectLimit && $tbl_orderdetail_list->StartRec > 1)
		$tbl_orderdetail_list->Recordset->move($tbl_orderdetail_list->StartRec - 1);
} elseif (!$tbl_orderdetail->AllowAddDeleteRow && $tbl_orderdetail_list->StopRec == 0) {
	$tbl_orderdetail_list->StopRec = $tbl_orderdetail->GridAddRowCount;
}

// Initialize aggregate
$tbl_orderdetail->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_orderdetail->resetAttributes();
$tbl_orderdetail_list->renderRow();
$tbl_orderdetail_list->EditRowCnt = 0;
if ($tbl_orderdetail->isEdit())
	$tbl_orderdetail_list->RowIndex = 1;
while ($tbl_orderdetail_list->RecCnt < $tbl_orderdetail_list->StopRec) {
	$tbl_orderdetail_list->RecCnt++;
	if ($tbl_orderdetail_list->RecCnt >= $tbl_orderdetail_list->StartRec) {
		$tbl_orderdetail_list->RowCnt++;

		// Set up key count
		$tbl_orderdetail_list->KeyCount = $tbl_orderdetail_list->RowIndex;

		// Init row class and style
		$tbl_orderdetail->resetAttributes();
		$tbl_orderdetail->CssClass = "";
		if ($tbl_orderdetail->isGridAdd()) {
			$tbl_orderdetail_list->loadRowValues(); // Load default values
		} else {
			$tbl_orderdetail_list->loadRowValues($tbl_orderdetail_list->Recordset); // Load row values
		}
		$tbl_orderdetail->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_orderdetail->isEdit()) {
			if ($tbl_orderdetail_list->checkInlineEditKey() && $tbl_orderdetail_list->EditRowCnt == 0) { // Inline edit
				$tbl_orderdetail->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_orderdetail->isEdit() && $tbl_orderdetail->RowType == ROWTYPE_EDIT && $tbl_orderdetail->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_orderdetail_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_orderdetail->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_orderdetail_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_orderdetail->RowAttrs = array_merge($tbl_orderdetail->RowAttrs, array('data-rowindex'=>$tbl_orderdetail_list->RowCnt, 'id'=>'r' . $tbl_orderdetail_list->RowCnt . '_tbl_orderdetail', 'data-rowtype'=>$tbl_orderdetail->RowType));

		// Render row
		$tbl_orderdetail_list->renderRow();

		// Render list options
		$tbl_orderdetail_list->renderListOptions();
?>
	<tr<?php echo $tbl_orderdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_orderdetail_list->ListOptions->render("body", "left", $tbl_orderdetail_list->RowCnt);
?>
	<?php if ($tbl_orderdetail->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_orderdetail->Code->cellAttributes() ?>>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderdetail_list->RowCnt ?>_tbl_orderdetail_Code" class="form-group tbl_orderdetail_Code">
<?php
$wrkonchange = "ew.autoFill(this);" . trim(@$tbl_orderdetail->Code->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$tbl_orderdetail->Code->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" class="text-nowrap" style="z-index: <?php echo (9000 - $tbl_orderdetail_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" id="sv_x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" value="<?php echo RemoveHtml($tbl_orderdetail->Code->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($tbl_orderdetail->Code->getPlaceHolder()) ?>"<?php echo $tbl_orderdetail->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_Code" data-value-separator="<?php echo $tbl_orderdetail->Code->displayValueSeparatorAttribute() ?>" name="x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" id="x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_orderdetail->Code->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftbl_orderdetaillist.createAutoSuggest({"id":"x<?php echo $tbl_orderdetail_list->RowIndex ?>_Code","forceSelect":true});
</script>
<?php echo $tbl_orderdetail->Code->Lookup->getParamTag("p_x" . $tbl_orderdetail_list->RowIndex . "_Code") ?>
</span>
<?php } ?>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderdetail_list->RowCnt ?>_tbl_orderdetail_Code" class="tbl_orderdetail_Code">
<span<?php echo $tbl_orderdetail->Code->viewAttributes() ?>>
<?php echo $tbl_orderdetail->Code->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_EDIT || $tbl_orderdetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_orderdetail" data-field="x_ID_Detail" name="x<?php echo $tbl_orderdetail_list->RowIndex ?>_ID_Detail" id="x<?php echo $tbl_orderdetail_list->RowIndex ?>_ID_Detail" value="<?php echo HtmlEncode($tbl_orderdetail->ID_Detail->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_orderdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $tbl_orderdetail->PCS->cellAttributes() ?>>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_orderdetail_list->RowCnt ?>_tbl_orderdetail_PCS" class="form-group tbl_orderdetail_PCS">
<input type="text" data-table="tbl_orderdetail" data-field="x_PCS" name="x<?php echo $tbl_orderdetail_list->RowIndex ?>_PCS" id="x<?php echo $tbl_orderdetail_list->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($tbl_orderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $tbl_orderdetail->PCS->EditValue ?>"<?php echo $tbl_orderdetail->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_orderdetail_list->RowCnt ?>_tbl_orderdetail_PCS" class="tbl_orderdetail_PCS">
<span<?php echo $tbl_orderdetail->PCS->viewAttributes() ?>>
<?php echo $tbl_orderdetail->PCS->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_orderdetail_list->ListOptions->render("body", "right", $tbl_orderdetail_list->RowCnt);
?>
	</tr>
<?php if ($tbl_orderdetail->RowType == ROWTYPE_ADD || $tbl_orderdetail->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_orderdetaillist.updateLists(<?php echo $tbl_orderdetail_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if (!$tbl_orderdetail->isGridAdd())
		$tbl_orderdetail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_orderdetail->isAdd() || $tbl_orderdetail->isCopy()) { ?>
<input type="hidden" name="<?php echo $tbl_orderdetail_list->FormKeyCountName ?>" id="<?php echo $tbl_orderdetail_list->FormKeyCountName ?>" value="<?php echo $tbl_orderdetail_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_orderdetail->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_orderdetail_list->FormKeyCountName ?>" id="<?php echo $tbl_orderdetail_list->FormKeyCountName ?>" value="<?php echo $tbl_orderdetail_list->KeyCount ?>">
<?php } ?>
<?php if (!$tbl_orderdetail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_orderdetail_list->Recordset)
	$tbl_orderdetail_list->Recordset->Close();
?>
<?php if (!$tbl_orderdetail->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_orderdetail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_orderdetail_list->Pager)) $tbl_orderdetail_list->Pager = new PrevNextPager($tbl_orderdetail_list->StartRec, $tbl_orderdetail_list->DisplayRecs, $tbl_orderdetail_list->TotalRecs, $tbl_orderdetail_list->AutoHidePager) ?>
<?php if ($tbl_orderdetail_list->Pager->RecordCount > 0 && $tbl_orderdetail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_orderdetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_orderdetail_list->pageUrl() ?>start=<?php echo $tbl_orderdetail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_orderdetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_orderdetail_list->pageUrl() ?>start=<?php echo $tbl_orderdetail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_orderdetail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_orderdetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_orderdetail_list->pageUrl() ?>start=<?php echo $tbl_orderdetail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_orderdetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_orderdetail_list->pageUrl() ?>start=<?php echo $tbl_orderdetail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_orderdetail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_orderdetail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_orderdetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_orderdetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_orderdetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_orderdetail_list->TotalRecs > 0 && (!$tbl_orderdetail_list->AutoHidePageSizeSelector || $tbl_orderdetail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_orderdetail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_orderdetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_orderdetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_orderdetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_orderdetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_orderdetail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_orderdetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_orderdetail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_orderdetail_list->TotalRecs == 0 && !$tbl_orderdetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_orderdetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_orderdetail_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_orderdetail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_orderdetail_list->terminate();
?>