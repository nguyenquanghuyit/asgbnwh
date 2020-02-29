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
$vworderdetail_list = new vworderdetail_list();

// Run the page
$vworderdetail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vworderdetail_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$vworderdetail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fvworderdetaillist = currentForm = new ew.Form("fvworderdetaillist", "list");
fvworderdetaillist.formKeyCountName = '<?php echo $vworderdetail_list->FormKeyCountName ?>';

// Validate form
fvworderdetaillist.validate = function() {
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
		<?php if ($vworderdetail_list->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->Code->caption(), $vworderdetail->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_list->PCS->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->PCS->caption(), $vworderdetail->PCS->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($vworderdetail->PCS->errorMessage()) ?>");
		<?php if ($vworderdetail_list->StatusPickUp->Required) { ?>
			elm = this.getElements("x" + infix + "_StatusPickUp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->StatusPickUp->caption(), $vworderdetail->StatusPickUp->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_list->CreateUser->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->CreateUser->caption(), $vworderdetail->CreateUser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($vworderdetail_list->CreateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_CreateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $vworderdetail->CreateDate->caption(), $vworderdetail->CreateDate->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fvworderdetaillist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fvworderdetaillist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fvworderdetaillist.lists["x_StatusPickUp"] = <?php echo $vworderdetail_list->StatusPickUp->Lookup->toClientList() ?>;
fvworderdetaillist.lists["x_StatusPickUp"].options = <?php echo JsonEncode($vworderdetail_list->StatusPickUp->options(FALSE, TRUE)) ?>;

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
<?php if (!$vworderdetail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vworderdetail_list->TotalRecs > 0 && $vworderdetail_list->ExportOptions->visible()) { ?>
<?php $vworderdetail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vworderdetail_list->ImportOptions->visible()) { ?>
<?php $vworderdetail_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$vworderdetail->isExport() || EXPORT_MASTER_RECORD && $vworderdetail->isExport("print")) { ?>
<?php
if ($vworderdetail_list->DbMasterFilter <> "" && $vworderdetail->getCurrentMasterTable() == "vwpickingbyorder") {
	if ($vworderdetail_list->MasterRecordExists) {
		include_once "vwpickingbyordermaster.php";
	}
}
?>
<?php } ?>
<?php
$vworderdetail_list->renderOtherOptions();
?>
<?php $vworderdetail_list->showPageHeader(); ?>
<?php
$vworderdetail_list->showMessage();
?>
<?php if ($vworderdetail_list->TotalRecs > 0 || $vworderdetail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vworderdetail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vworderdetail">
<?php if (!$vworderdetail->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vworderdetail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vworderdetail_list->Pager)) $vworderdetail_list->Pager = new PrevNextPager($vworderdetail_list->StartRec, $vworderdetail_list->DisplayRecs, $vworderdetail_list->TotalRecs, $vworderdetail_list->AutoHidePager) ?>
<?php if ($vworderdetail_list->Pager->RecordCount > 0 && $vworderdetail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vworderdetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vworderdetail_list->pageUrl() ?>start=<?php echo $vworderdetail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vworderdetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vworderdetail_list->pageUrl() ?>start=<?php echo $vworderdetail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vworderdetail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vworderdetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vworderdetail_list->pageUrl() ?>start=<?php echo $vworderdetail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vworderdetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vworderdetail_list->pageUrl() ?>start=<?php echo $vworderdetail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vworderdetail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vworderdetail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vworderdetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vworderdetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vworderdetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vworderdetail_list->TotalRecs > 0 && (!$vworderdetail_list->AutoHidePageSizeSelector || $vworderdetail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vworderdetail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vworderdetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vworderdetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vworderdetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vworderdetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vworderdetail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vworderdetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vworderdetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvworderdetaillist" id="fvworderdetaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($vworderdetail_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $vworderdetail_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vworderdetail">
<input type="hidden" name="exporttype" id="exporttype" value="">
<?php if ($vworderdetail->getCurrentMasterTable() == "vwpickingbyorder" && $vworderdetail->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="vwpickingbyorder">
<input type="hidden" name="fk_ID_Order" value="<?php echo $vworderdetail->ID_Order->getSessionValue() ?>">
<?php } ?>
<div id="gmp_vworderdetail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($vworderdetail_list->TotalRecs > 0 || $vworderdetail->isGridEdit()) { ?>
<table id="tbl_vworderdetaillist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vworderdetail_list->RowType = ROWTYPE_HEADER;

// Render list options
$vworderdetail_list->renderListOptions();

// Render list options (header, left)
$vworderdetail_list->ListOptions->render("header", "left");
?>
<?php if ($vworderdetail->Code->Visible) { // Code ?>
	<?php if ($vworderdetail->sortUrl($vworderdetail->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $vworderdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderdetail_Code" class="vworderdetail_Code"><div class="ew-table-header-caption"><?php echo $vworderdetail->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $vworderdetail->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderdetail->SortUrl($vworderdetail->Code) ?>',2);"><div id="elh_vworderdetail_Code" class="vworderdetail_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderdetail->Code->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderdetail->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderdetail->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->PCS->Visible) { // PCS ?>
	<?php if ($vworderdetail->sortUrl($vworderdetail->PCS) == "") { ?>
		<th data-name="PCS" class="<?php echo $vworderdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderdetail_PCS" class="vworderdetail_PCS"><div class="ew-table-header-caption"><?php echo $vworderdetail->PCS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS" class="<?php echo $vworderdetail->PCS->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderdetail->SortUrl($vworderdetail->PCS) ?>',2);"><div id="elh_vworderdetail_PCS" class="vworderdetail_PCS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderdetail->PCS->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderdetail->PCS->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderdetail->PCS->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->StatusPickUp->Visible) { // StatusPickUp ?>
	<?php if ($vworderdetail->sortUrl($vworderdetail->StatusPickUp) == "") { ?>
		<th data-name="StatusPickUp" class="<?php echo $vworderdetail->StatusPickUp->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderdetail_StatusPickUp" class="vworderdetail_StatusPickUp"><div class="ew-table-header-caption"><?php echo $vworderdetail->StatusPickUp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StatusPickUp" class="<?php echo $vworderdetail->StatusPickUp->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderdetail->SortUrl($vworderdetail->StatusPickUp) ?>',2);"><div id="elh_vworderdetail_StatusPickUp" class="vworderdetail_StatusPickUp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderdetail->StatusPickUp->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderdetail->StatusPickUp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderdetail->StatusPickUp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vworderdetail->sortUrl($vworderdetail->CreateUser) == "") { ?>
		<th data-name="CreateUser" class="<?php echo $vworderdetail->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderdetail_CreateUser" class="vworderdetail_CreateUser"><div class="ew-table-header-caption"><?php echo $vworderdetail->CreateUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateUser" class="<?php echo $vworderdetail->CreateUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderdetail->SortUrl($vworderdetail->CreateUser) ?>',2);"><div id="elh_vworderdetail_CreateUser" class="vworderdetail_CreateUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderdetail->CreateUser->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderdetail->CreateUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderdetail->CreateUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vworderdetail->sortUrl($vworderdetail->CreateDate) == "") { ?>
		<th data-name="CreateDate" class="<?php echo $vworderdetail->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_vworderdetail_CreateDate" class="vworderdetail_CreateDate"><div class="ew-table-header-caption"><?php echo $vworderdetail->CreateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CreateDate" class="<?php echo $vworderdetail->CreateDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $vworderdetail->SortUrl($vworderdetail->CreateDate) ?>',2);"><div id="elh_vworderdetail_CreateDate" class="vworderdetail_CreateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vworderdetail->CreateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($vworderdetail->CreateDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($vworderdetail->CreateDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vworderdetail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vworderdetail->ExportAll && $vworderdetail->isExport()) {
	$vworderdetail_list->StopRec = $vworderdetail_list->TotalRecs;
} else {

	// Set the last record to display
	if ($vworderdetail_list->TotalRecs > $vworderdetail_list->StartRec + $vworderdetail_list->DisplayRecs - 1)
		$vworderdetail_list->StopRec = $vworderdetail_list->StartRec + $vworderdetail_list->DisplayRecs - 1;
	else
		$vworderdetail_list->StopRec = $vworderdetail_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $vworderdetail_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($vworderdetail_list->FormKeyCountName) && ($vworderdetail->isGridAdd() || $vworderdetail->isGridEdit() || $vworderdetail->isConfirm())) {
		$vworderdetail_list->KeyCount = $CurrentForm->getValue($vworderdetail_list->FormKeyCountName);
		$vworderdetail_list->StopRec = $vworderdetail_list->StartRec + $vworderdetail_list->KeyCount - 1;
	}
}
$vworderdetail_list->RecCnt = $vworderdetail_list->StartRec - 1;
if ($vworderdetail_list->Recordset && !$vworderdetail_list->Recordset->EOF) {
	$vworderdetail_list->Recordset->moveFirst();
	$selectLimit = $vworderdetail_list->UseSelectLimit;
	if (!$selectLimit && $vworderdetail_list->StartRec > 1)
		$vworderdetail_list->Recordset->move($vworderdetail_list->StartRec - 1);
} elseif (!$vworderdetail->AllowAddDeleteRow && $vworderdetail_list->StopRec == 0) {
	$vworderdetail_list->StopRec = $vworderdetail->GridAddRowCount;
}

// Initialize aggregate
$vworderdetail->RowType = ROWTYPE_AGGREGATEINIT;
$vworderdetail->resetAttributes();
$vworderdetail_list->renderRow();
$vworderdetail_list->EditRowCnt = 0;
if ($vworderdetail->isEdit())
	$vworderdetail_list->RowIndex = 1;
while ($vworderdetail_list->RecCnt < $vworderdetail_list->StopRec) {
	$vworderdetail_list->RecCnt++;
	if ($vworderdetail_list->RecCnt >= $vworderdetail_list->StartRec) {
		$vworderdetail_list->RowCnt++;

		// Set up key count
		$vworderdetail_list->KeyCount = $vworderdetail_list->RowIndex;

		// Init row class and style
		$vworderdetail->resetAttributes();
		$vworderdetail->CssClass = "";
		if ($vworderdetail->isGridAdd()) {
			$vworderdetail_list->loadRowValues(); // Load default values
		} else {
			$vworderdetail_list->loadRowValues($vworderdetail_list->Recordset); // Load row values
		}
		$vworderdetail->RowType = ROWTYPE_VIEW; // Render view
		if ($vworderdetail->isEdit()) {
			if ($vworderdetail_list->checkInlineEditKey() && $vworderdetail_list->EditRowCnt == 0) { // Inline edit
				$vworderdetail->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($vworderdetail->isEdit() && $vworderdetail->RowType == ROWTYPE_EDIT && $vworderdetail->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$vworderdetail_list->restoreFormValues(); // Restore form values
		}
		if ($vworderdetail->RowType == ROWTYPE_EDIT) // Edit row
			$vworderdetail_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$vworderdetail->RowAttrs = array_merge($vworderdetail->RowAttrs, array('data-rowindex'=>$vworderdetail_list->RowCnt, 'id'=>'r' . $vworderdetail_list->RowCnt . '_vworderdetail', 'data-rowtype'=>$vworderdetail->RowType));

		// Render row
		$vworderdetail_list->renderRow();

		// Render list options
		$vworderdetail_list->renderListOptions();
?>
	<tr<?php echo $vworderdetail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vworderdetail_list->ListOptions->render("body", "left", $vworderdetail_list->RowCnt);
?>
	<?php if ($vworderdetail->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $vworderdetail->Code->cellAttributes() ?>>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderdetail_list->RowCnt ?>_vworderdetail_Code" class="form-group vworderdetail_Code">
<input type="text" data-table="vworderdetail" data-field="x_Code" name="x<?php echo $vworderdetail_list->RowIndex ?>_Code" id="x<?php echo $vworderdetail_list->RowIndex ?>_Code" size="15" maxlength="50" placeholder="<?php echo HtmlEncode($vworderdetail->Code->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->Code->EditValue ?>"<?php echo $vworderdetail->Code->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderdetail_list->RowCnt ?>_vworderdetail_Code" class="vworderdetail_Code">
<span<?php echo $vworderdetail->Code->viewAttributes() ?>>
<?php echo $vworderdetail->Code->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT || $vworderdetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="vworderdetail" data-field="x_ID_Detail" name="x<?php echo $vworderdetail_list->RowIndex ?>_ID_Detail" id="x<?php echo $vworderdetail_list->RowIndex ?>_ID_Detail" value="<?php echo HtmlEncode($vworderdetail->ID_Detail->CurrentValue) ?>">
<?php } ?>
	<?php if ($vworderdetail->PCS->Visible) { // PCS ?>
		<td data-name="PCS"<?php echo $vworderdetail->PCS->cellAttributes() ?>>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderdetail_list->RowCnt ?>_vworderdetail_PCS" class="form-group vworderdetail_PCS">
<input type="text" data-table="vworderdetail" data-field="x_PCS" name="x<?php echo $vworderdetail_list->RowIndex ?>_PCS" id="x<?php echo $vworderdetail_list->RowIndex ?>_PCS" size="5" placeholder="<?php echo HtmlEncode($vworderdetail->PCS->getPlaceHolder()) ?>" value="<?php echo $vworderdetail->PCS->EditValue ?>"<?php echo $vworderdetail->PCS->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderdetail_list->RowCnt ?>_vworderdetail_PCS" class="vworderdetail_PCS">
<span<?php echo $vworderdetail->PCS->viewAttributes() ?>>
<?php echo $vworderdetail->PCS->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderdetail->StatusPickUp->Visible) { // StatusPickUp ?>
		<td data-name="StatusPickUp"<?php echo $vworderdetail->StatusPickUp->cellAttributes() ?>>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $vworderdetail_list->RowCnt ?>_vworderdetail_StatusPickUp" class="form-group vworderdetail_StatusPickUp">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vworderdetail" data-field="x_StatusPickUp" data-value-separator="<?php echo $vworderdetail->StatusPickUp->displayValueSeparatorAttribute() ?>" id="x<?php echo $vworderdetail_list->RowIndex ?>_StatusPickUp" name="x<?php echo $vworderdetail_list->RowIndex ?>_StatusPickUp"<?php echo $vworderdetail->StatusPickUp->editAttributes() ?>>
		<?php echo $vworderdetail->StatusPickUp->selectOptionListHtml("x<?php echo $vworderdetail_list->RowIndex ?>_StatusPickUp") ?>
	</select>
</div>
</span>
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderdetail_list->RowCnt ?>_vworderdetail_StatusPickUp" class="vworderdetail_StatusPickUp">
<span<?php echo $vworderdetail->StatusPickUp->viewAttributes() ?>>
<?php echo $vworderdetail->StatusPickUp->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderdetail->CreateUser->Visible) { // CreateUser ?>
		<td data-name="CreateUser"<?php echo $vworderdetail->CreateUser->cellAttributes() ?>>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderdetail_list->RowCnt ?>_vworderdetail_CreateUser" class="vworderdetail_CreateUser">
<span<?php echo $vworderdetail->CreateUser->viewAttributes() ?>>
<?php echo $vworderdetail->CreateUser->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($vworderdetail->CreateDate->Visible) { // CreateDate ?>
		<td data-name="CreateDate"<?php echo $vworderdetail->CreateDate->cellAttributes() ?>>
<?php if ($vworderdetail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($vworderdetail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $vworderdetail_list->RowCnt ?>_vworderdetail_CreateDate" class="vworderdetail_CreateDate">
<span<?php echo $vworderdetail->CreateDate->viewAttributes() ?>>
<?php echo $vworderdetail->CreateDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vworderdetail_list->ListOptions->render("body", "right", $vworderdetail_list->RowCnt);
?>
	</tr>
<?php if ($vworderdetail->RowType == ROWTYPE_ADD || $vworderdetail->RowType == ROWTYPE_EDIT) { ?>
<script>
fvworderdetaillist.updateLists(<?php echo $vworderdetail_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if (!$vworderdetail->isGridAdd())
		$vworderdetail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($vworderdetail->isEdit()) { ?>
<input type="hidden" name="<?php echo $vworderdetail_list->FormKeyCountName ?>" id="<?php echo $vworderdetail_list->FormKeyCountName ?>" value="<?php echo $vworderdetail_list->KeyCount ?>">
<?php } ?>
<?php if (!$vworderdetail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vworderdetail_list->Recordset)
	$vworderdetail_list->Recordset->Close();
?>
<?php if (!$vworderdetail->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vworderdetail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($vworderdetail_list->Pager)) $vworderdetail_list->Pager = new PrevNextPager($vworderdetail_list->StartRec, $vworderdetail_list->DisplayRecs, $vworderdetail_list->TotalRecs, $vworderdetail_list->AutoHidePager) ?>
<?php if ($vworderdetail_list->Pager->RecordCount > 0 && $vworderdetail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($vworderdetail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $vworderdetail_list->pageUrl() ?>start=<?php echo $vworderdetail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($vworderdetail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $vworderdetail_list->pageUrl() ?>start=<?php echo $vworderdetail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $vworderdetail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($vworderdetail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $vworderdetail_list->pageUrl() ?>start=<?php echo $vworderdetail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($vworderdetail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $vworderdetail_list->pageUrl() ?>start=<?php echo $vworderdetail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vworderdetail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($vworderdetail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vworderdetail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vworderdetail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vworderdetail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($vworderdetail_list->TotalRecs > 0 && (!$vworderdetail_list->AutoHidePageSizeSelector || $vworderdetail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="vworderdetail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($vworderdetail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($vworderdetail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($vworderdetail_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($vworderdetail_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($vworderdetail_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($vworderdetail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vworderdetail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vworderdetail_list->TotalRecs == 0 && !$vworderdetail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vworderdetail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vworderdetail_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$vworderdetail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$vworderdetail_list->terminate();
?>