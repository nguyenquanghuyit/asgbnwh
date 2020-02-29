<?php
namespace PHPMaker2019\asgbn_wh;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
include_once "mycnn.php";

$userId=CurrentUserName();
$strPO="CALL procPO_INV('".$userId."')";
mysqli_query($cnn,$strPO);
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tbl_order_po_inv_list = new tbl_order_po_inv_list();

// Run the page
$tbl_order_po_inv_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_order_po_inv_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_order_po_inv->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_order_po_invlist = currentForm = new ew.Form("ftbl_order_po_invlist", "list");
ftbl_order_po_invlist.formKeyCountName = '<?php echo $tbl_order_po_inv_list->FormKeyCountName ?>';

// Validate form
ftbl_order_po_invlist.validate = function() {
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
		<?php if ($tbl_order_po_inv_list->OrderNo->Required) { ?>
			elm = this.getElements("x" + infix + "_OrderNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->OrderNo->caption(), $tbl_order_po_inv->OrderNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_list->Code->Required) { ?>
			elm = this.getElements("x" + infix + "_Code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->Code->caption(), $tbl_order_po_inv->Code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_list->PalletNo->Required) { ?>
			elm = this.getElements("x" + infix + "_PalletNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PalletNo->caption(), $tbl_order_po_inv->PalletNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_list->DateIn->Required) { ?>
			elm = this.getElements("x" + infix + "_DateIn");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->DateIn->caption(), $tbl_order_po_inv->DateIn->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_list->PCS_In->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_In");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PCS_In->caption(), $tbl_order_po_inv->PCS_In->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_list->PCS_Out->Required) { ?>
			elm = this.getElements("x" + infix + "_PCS_Out");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PCS_Out->caption(), $tbl_order_po_inv->PCS_Out->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PCS_Out");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_order_po_inv->PCS_Out->errorMessage()) ?>");
		<?php if ($tbl_order_po_inv_list->PO_No->Required) { ?>
			elm = this.getElements("x" + infix + "_PO_No");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PO_No->caption(), $tbl_order_po_inv->PO_No->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_list->INV_No->Required) { ?>
			elm = this.getElements("x" + infix + "_INV_No");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->INV_No->caption(), $tbl_order_po_inv->INV_No->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_list->PO_InputDate->Required) { ?>
			elm = this.getElements("x" + infix + "_PO_InputDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PO_InputDate->caption(), $tbl_order_po_inv->PO_InputDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_order_po_inv_list->PO_InputUser->Required) { ?>
			elm = this.getElements("x" + infix + "_PO_InputUser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_order_po_inv->PO_InputUser->caption(), $tbl_order_po_inv->PO_InputUser->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_order_po_invlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_order_po_invlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftbl_order_po_invlistsrch = currentSearchForm = new ew.Form("ftbl_order_po_invlistsrch");

// Validate function for search
ftbl_order_po_invlistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_OrderNo");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($tbl_order_po_inv->OrderNo->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ftbl_order_po_invlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_order_po_invlistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Filters

ftbl_order_po_invlistsrch.filterList = <?php echo $tbl_order_po_inv_list->getFilterList() ?>;
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
<?php if (!$tbl_order_po_inv->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_order_po_inv_list->TotalRecs > 0 && $tbl_order_po_inv_list->ExportOptions->visible()) { ?>
<?php $tbl_order_po_inv_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_order_po_inv_list->ImportOptions->visible()) { ?>
<?php $tbl_order_po_inv_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_order_po_inv_list->SearchOptions->visible()) { ?>
<?php $tbl_order_po_inv_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_order_po_inv_list->FilterOptions->visible()) { ?>
<?php $tbl_order_po_inv_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_order_po_inv_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_order_po_inv->isExport() && !$tbl_order_po_inv->CurrentAction) { ?>
<form name="ftbl_order_po_invlistsrch" id="ftbl_order_po_invlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_order_po_inv_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_order_po_invlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_order_po_inv">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$tbl_order_po_inv_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_order_po_inv->RowType = ROWTYPE_SEARCH;

// Render row
$tbl_order_po_inv->resetAttributes();
$tbl_order_po_inv_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($tbl_order_po_inv->OrderNo->Visible) { // OrderNo ?>
	<div id="xsc_OrderNo" class="ew-cell form-group">
		<label for="x_OrderNo" class="ew-search-caption ew-label"><?php echo $tbl_order_po_inv->OrderNo->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_OrderNo" id="z_OrderNo" value="="></span>
		<span class="ew-search-field">
<input type="text" data-table="tbl_order_po_inv" data-field="x_OrderNo" name="x_OrderNo" id="x_OrderNo" size="30" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->OrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->OrderNo->EditValue ?>"<?php echo $tbl_order_po_inv->OrderNo->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_order_po_inv_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_order_po_inv_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_order_po_inv_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_order_po_inv_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_order_po_inv_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_order_po_inv_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_order_po_inv_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_order_po_inv_list->showPageHeader(); ?>
<?php
$tbl_order_po_inv_list->showMessage();
?>
<?php if ($tbl_order_po_inv_list->TotalRecs > 0 || $tbl_order_po_inv->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_order_po_inv_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_order_po_inv">
<?php if (!$tbl_order_po_inv->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_order_po_inv->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_order_po_inv_list->Pager)) $tbl_order_po_inv_list->Pager = new PrevNextPager($tbl_order_po_inv_list->StartRec, $tbl_order_po_inv_list->DisplayRecs, $tbl_order_po_inv_list->TotalRecs, $tbl_order_po_inv_list->AutoHidePager) ?>
<?php if ($tbl_order_po_inv_list->Pager->RecordCount > 0 && $tbl_order_po_inv_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_order_po_inv_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_order_po_inv_list->pageUrl() ?>start=<?php echo $tbl_order_po_inv_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_order_po_inv_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_order_po_inv_list->pageUrl() ?>start=<?php echo $tbl_order_po_inv_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_order_po_inv_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_order_po_inv_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_order_po_inv_list->pageUrl() ?>start=<?php echo $tbl_order_po_inv_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_order_po_inv_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_order_po_inv_list->pageUrl() ?>start=<?php echo $tbl_order_po_inv_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_order_po_inv_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_order_po_inv_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_order_po_inv_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_order_po_inv_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_order_po_inv_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_order_po_inv_list->TotalRecs > 0 && (!$tbl_order_po_inv_list->AutoHidePageSizeSelector || $tbl_order_po_inv_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_order_po_inv">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_order_po_inv_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_order_po_inv_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_order_po_inv_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_order_po_inv_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_order_po_inv_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_order_po_inv->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
PO <input type="text" size="5" id="idPO">&nbsp; INV&nbsp;<input id="idINV" type="text" size=5> <input hieuung="tooltip" title="Update PO and INV no" id="idInput" type="button" class="btn btn-danger" value="Input">

<div class="ew-list-other-options">
<?php $tbl_order_po_inv_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_order_po_invlist" id="ftbl_order_po_invlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_order_po_inv_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_order_po_inv_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_order_po_inv">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_order_po_inv" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_order_po_inv_list->TotalRecs > 0 || $tbl_order_po_inv->isGridEdit()) { ?>
<table id="tbl_tbl_order_po_invlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_order_po_inv_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_order_po_inv_list->renderListOptions();

// Render list options (header, left)
$tbl_order_po_inv_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_order_po_inv->OrderNo->Visible) { // OrderNo ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->OrderNo) == "") { ?>
		<th data-name="OrderNo" class="<?php echo $tbl_order_po_inv->OrderNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_OrderNo" class="tbl_order_po_inv_OrderNo"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->OrderNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrderNo" class="<?php echo $tbl_order_po_inv->OrderNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order_po_inv->SortUrl($tbl_order_po_inv->OrderNo) ?>',2);"><div id="elh_tbl_order_po_inv_OrderNo" class="tbl_order_po_inv_OrderNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->OrderNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->OrderNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->OrderNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->Code->Visible) { // Code ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->Code) == "") { ?>
		<th data-name="Code" class="<?php echo $tbl_order_po_inv->Code->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_Code" class="tbl_order_po_inv_Code"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Code" class="<?php echo $tbl_order_po_inv->Code->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order_po_inv->SortUrl($tbl_order_po_inv->Code) ?>',2);"><div id="elh_tbl_order_po_inv_Code" class="tbl_order_po_inv_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->Code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->Code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PalletNo->Visible) { // PalletNo ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PalletNo) == "") { ?>
		<th data-name="PalletNo" class="<?php echo $tbl_order_po_inv->PalletNo->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PalletNo" class="tbl_order_po_inv_PalletNo"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PalletNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PalletNo" class="<?php echo $tbl_order_po_inv->PalletNo->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order_po_inv->SortUrl($tbl_order_po_inv->PalletNo) ?>',2);"><div id="elh_tbl_order_po_inv_PalletNo" class="tbl_order_po_inv_PalletNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PalletNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PalletNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PalletNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->DateIn) == "") { ?>
		<th data-name="DateIn" class="<?php echo $tbl_order_po_inv->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_DateIn" class="tbl_order_po_inv_DateIn"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->DateIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateIn" class="<?php echo $tbl_order_po_inv->DateIn->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order_po_inv->SortUrl($tbl_order_po_inv->DateIn) ?>',2);"><div id="elh_tbl_order_po_inv_DateIn" class="tbl_order_po_inv_DateIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->DateIn->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->DateIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->DateIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_In->Visible) { // PCS_In ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PCS_In) == "") { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_order_po_inv->PCS_In->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PCS_In" class="tbl_order_po_inv_PCS_In"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PCS_In->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_In" class="<?php echo $tbl_order_po_inv->PCS_In->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order_po_inv->SortUrl($tbl_order_po_inv->PCS_In) ?>',2);"><div id="elh_tbl_order_po_inv_PCS_In" class="tbl_order_po_inv_PCS_In">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PCS_In->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PCS_In->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PCS_In->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_Out->Visible) { // PCS_Out ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PCS_Out) == "") { ?>
		<th data-name="PCS_Out" class="<?php echo $tbl_order_po_inv->PCS_Out->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PCS_Out" class="tbl_order_po_inv_PCS_Out"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PCS_Out->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PCS_Out" class="<?php echo $tbl_order_po_inv->PCS_Out->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order_po_inv->SortUrl($tbl_order_po_inv->PCS_Out) ?>',2);"><div id="elh_tbl_order_po_inv_PCS_Out" class="tbl_order_po_inv_PCS_Out">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PCS_Out->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PCS_Out->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PCS_Out->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_No->Visible) { // PO_No ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PO_No) == "") { ?>
		<th data-name="PO_No" class="<?php echo $tbl_order_po_inv->PO_No->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PO_No" class="tbl_order_po_inv_PO_No"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_No->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PO_No" class="<?php echo $tbl_order_po_inv->PO_No->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order_po_inv->SortUrl($tbl_order_po_inv->PO_No) ?>',2);"><div id="elh_tbl_order_po_inv_PO_No" class="tbl_order_po_inv_PO_No">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_No->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PO_No->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PO_No->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->INV_No->Visible) { // INV_No ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->INV_No) == "") { ?>
		<th data-name="INV_No" class="<?php echo $tbl_order_po_inv->INV_No->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_INV_No" class="tbl_order_po_inv_INV_No"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->INV_No->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="INV_No" class="<?php echo $tbl_order_po_inv->INV_No->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order_po_inv->SortUrl($tbl_order_po_inv->INV_No) ?>',2);"><div id="elh_tbl_order_po_inv_INV_No" class="tbl_order_po_inv_INV_No">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->INV_No->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->INV_No->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->INV_No->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_InputDate->Visible) { // PO_InputDate ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PO_InputDate) == "") { ?>
		<th data-name="PO_InputDate" class="<?php echo $tbl_order_po_inv->PO_InputDate->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PO_InputDate" class="tbl_order_po_inv_PO_InputDate"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_InputDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PO_InputDate" class="<?php echo $tbl_order_po_inv->PO_InputDate->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order_po_inv->SortUrl($tbl_order_po_inv->PO_InputDate) ?>',2);"><div id="elh_tbl_order_po_inv_PO_InputDate" class="tbl_order_po_inv_PO_InputDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_InputDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PO_InputDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PO_InputDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_InputUser->Visible) { // PO_InputUser ?>
	<?php if ($tbl_order_po_inv->sortUrl($tbl_order_po_inv->PO_InputUser) == "") { ?>
		<th data-name="PO_InputUser" class="<?php echo $tbl_order_po_inv->PO_InputUser->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_order_po_inv_PO_InputUser" class="tbl_order_po_inv_PO_InputUser"><div class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_InputUser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PO_InputUser" class="<?php echo $tbl_order_po_inv->PO_InputUser->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_order_po_inv->SortUrl($tbl_order_po_inv->PO_InputUser) ?>',2);"><div id="elh_tbl_order_po_inv_PO_InputUser" class="tbl_order_po_inv_PO_InputUser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_InputUser->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_order_po_inv->PO_InputUser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_order_po_inv->PO_InputUser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_order_po_inv_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_order_po_inv->ExportAll && $tbl_order_po_inv->isExport()) {
	$tbl_order_po_inv_list->StopRec = $tbl_order_po_inv_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_order_po_inv_list->TotalRecs > $tbl_order_po_inv_list->StartRec + $tbl_order_po_inv_list->DisplayRecs - 1)
		$tbl_order_po_inv_list->StopRec = $tbl_order_po_inv_list->StartRec + $tbl_order_po_inv_list->DisplayRecs - 1;
	else
		$tbl_order_po_inv_list->StopRec = $tbl_order_po_inv_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_order_po_inv_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_order_po_inv_list->FormKeyCountName) && ($tbl_order_po_inv->isGridAdd() || $tbl_order_po_inv->isGridEdit() || $tbl_order_po_inv->isConfirm())) {
		$tbl_order_po_inv_list->KeyCount = $CurrentForm->getValue($tbl_order_po_inv_list->FormKeyCountName);
		$tbl_order_po_inv_list->StopRec = $tbl_order_po_inv_list->StartRec + $tbl_order_po_inv_list->KeyCount - 1;
	}
}
$tbl_order_po_inv_list->RecCnt = $tbl_order_po_inv_list->StartRec - 1;
if ($tbl_order_po_inv_list->Recordset && !$tbl_order_po_inv_list->Recordset->EOF) {
	$tbl_order_po_inv_list->Recordset->moveFirst();
	$selectLimit = $tbl_order_po_inv_list->UseSelectLimit;
	if (!$selectLimit && $tbl_order_po_inv_list->StartRec > 1)
		$tbl_order_po_inv_list->Recordset->move($tbl_order_po_inv_list->StartRec - 1);
} elseif (!$tbl_order_po_inv->AllowAddDeleteRow && $tbl_order_po_inv_list->StopRec == 0) {
	$tbl_order_po_inv_list->StopRec = $tbl_order_po_inv->GridAddRowCount;
}

// Initialize aggregate
$tbl_order_po_inv->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_order_po_inv->resetAttributes();
$tbl_order_po_inv_list->renderRow();
$tbl_order_po_inv_list->EditRowCnt = 0;
if ($tbl_order_po_inv->isEdit())
	$tbl_order_po_inv_list->RowIndex = 1;
if ($tbl_order_po_inv->isGridEdit())
	$tbl_order_po_inv_list->RowIndex = 0;
while ($tbl_order_po_inv_list->RecCnt < $tbl_order_po_inv_list->StopRec) {
	$tbl_order_po_inv_list->RecCnt++;
	if ($tbl_order_po_inv_list->RecCnt >= $tbl_order_po_inv_list->StartRec) {
		$tbl_order_po_inv_list->RowCnt++;
		if ($tbl_order_po_inv->isGridAdd() || $tbl_order_po_inv->isGridEdit() || $tbl_order_po_inv->isConfirm()) {
			$tbl_order_po_inv_list->RowIndex++;
			$CurrentForm->Index = $tbl_order_po_inv_list->RowIndex;
			if ($CurrentForm->hasValue($tbl_order_po_inv_list->FormActionName) && $tbl_order_po_inv_list->EventCancelled)
				$tbl_order_po_inv_list->RowAction = strval($CurrentForm->getValue($tbl_order_po_inv_list->FormActionName));
			elseif ($tbl_order_po_inv->isGridAdd())
				$tbl_order_po_inv_list->RowAction = "insert";
			else
				$tbl_order_po_inv_list->RowAction = "";
		}

		// Set up key count
		$tbl_order_po_inv_list->KeyCount = $tbl_order_po_inv_list->RowIndex;

		// Init row class and style
		$tbl_order_po_inv->resetAttributes();
		$tbl_order_po_inv->CssClass = "";
		if ($tbl_order_po_inv->isGridAdd()) {
			$tbl_order_po_inv_list->loadRowValues(); // Load default values
		} else {
			$tbl_order_po_inv_list->loadRowValues($tbl_order_po_inv_list->Recordset); // Load row values
		}
		$tbl_order_po_inv->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_order_po_inv->isEdit()) {
			if ($tbl_order_po_inv_list->checkInlineEditKey() && $tbl_order_po_inv_list->EditRowCnt == 0) { // Inline edit
				$tbl_order_po_inv->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_order_po_inv->isGridEdit()) { // Grid edit
			if ($tbl_order_po_inv->EventCancelled)
				$tbl_order_po_inv_list->restoreCurrentRowFormValues($tbl_order_po_inv_list->RowIndex); // Restore form values
			if ($tbl_order_po_inv_list->RowAction == "insert")
				$tbl_order_po_inv->RowType = ROWTYPE_ADD; // Render add
			else
				$tbl_order_po_inv->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($tbl_order_po_inv->isEdit() && $tbl_order_po_inv->RowType == ROWTYPE_EDIT && $tbl_order_po_inv->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_order_po_inv_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_order_po_inv->isGridEdit() && ($tbl_order_po_inv->RowType == ROWTYPE_EDIT || $tbl_order_po_inv->RowType == ROWTYPE_ADD) && $tbl_order_po_inv->EventCancelled) // Update failed
			$tbl_order_po_inv_list->restoreCurrentRowFormValues($tbl_order_po_inv_list->RowIndex); // Restore form values
		if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_order_po_inv_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_order_po_inv->RowAttrs = array_merge($tbl_order_po_inv->RowAttrs, array('data-rowindex'=>$tbl_order_po_inv_list->RowCnt, 'id'=>'r' . $tbl_order_po_inv_list->RowCnt . '_tbl_order_po_inv', 'data-rowtype'=>$tbl_order_po_inv->RowType));

		// Render row
		$tbl_order_po_inv_list->renderRow();

		// Render list options
		$tbl_order_po_inv_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($tbl_order_po_inv_list->RowAction <> "delete" && $tbl_order_po_inv_list->RowAction <> "insertdelete" && !($tbl_order_po_inv_list->RowAction == "insert" && $tbl_order_po_inv->isConfirm() && $tbl_order_po_inv_list->emptyRow())) {
?>
	<tr<?php echo $tbl_order_po_inv->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_order_po_inv_list->ListOptions->render("body", "left", $tbl_order_po_inv_list->RowCnt);
?>
	<?php if ($tbl_order_po_inv->OrderNo->Visible) { // OrderNo ?>
		<td data-name="OrderNo"<?php echo $tbl_order_po_inv->OrderNo->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_OrderNo" class="form-group tbl_order_po_inv_OrderNo">
<input type="text" data-table="tbl_order_po_inv" data-field="x_OrderNo" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_OrderNo" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_OrderNo" size="30" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->OrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->OrderNo->EditValue ?>"<?php echo $tbl_order_po_inv->OrderNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_OrderNo" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_OrderNo" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_OrderNo" value="<?php echo HtmlEncode($tbl_order_po_inv->OrderNo->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_OrderNo" class="form-group tbl_order_po_inv_OrderNo">
<span<?php echo $tbl_order_po_inv->OrderNo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->OrderNo->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_OrderNo" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_OrderNo" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_OrderNo" value="<?php echo HtmlEncode($tbl_order_po_inv->OrderNo->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_OrderNo" class="tbl_order_po_inv_OrderNo">
<span<?php echo $tbl_order_po_inv->OrderNo->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->OrderNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_ID_PoInv" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_ID_PoInv" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_ID_PoInv" value="<?php echo HtmlEncode($tbl_order_po_inv->ID_PoInv->CurrentValue) ?>">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_ID_PoInv" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_ID_PoInv" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_ID_PoInv" value="<?php echo HtmlEncode($tbl_order_po_inv->ID_PoInv->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT || $tbl_order_po_inv->CurrentMode == "edit") { ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_ID_PoInv" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_ID_PoInv" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_ID_PoInv" value="<?php echo HtmlEncode($tbl_order_po_inv->ID_PoInv->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_order_po_inv->Code->Visible) { // Code ?>
		<td data-name="Code"<?php echo $tbl_order_po_inv->Code->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_Code" class="form-group tbl_order_po_inv_Code">
<input type="text" data-table="tbl_order_po_inv" data-field="x_Code" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_Code" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_Code" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->Code->EditValue ?>"<?php echo $tbl_order_po_inv->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_Code" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_Code" class="form-group tbl_order_po_inv_Code">
<span<?php echo $tbl_order_po_inv->Code->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->Code->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_Code" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_Code" class="tbl_order_po_inv_Code">
<span<?php echo $tbl_order_po_inv->Code->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->Code->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PalletNo->Visible) { // PalletNo ?>
		<td data-name="PalletNo"<?php echo $tbl_order_po_inv->PalletNo->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PalletNo" class="form-group tbl_order_po_inv_PalletNo">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PalletNo" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PalletNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PalletNo->EditValue ?>"<?php echo $tbl_order_po_inv->PalletNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PalletNo" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PalletNo" class="form-group tbl_order_po_inv_PalletNo">
<span<?php echo $tbl_order_po_inv->PalletNo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PalletNo->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PalletNo" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PalletNo" class="tbl_order_po_inv_PalletNo">
<span<?php echo $tbl_order_po_inv->PalletNo->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PalletNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn"<?php echo $tbl_order_po_inv->DateIn->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_DateIn" class="form-group tbl_order_po_inv_DateIn">
<input type="text" data-table="tbl_order_po_inv" data-field="x_DateIn" data-format="7" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->DateIn->EditValue ?>"<?php echo $tbl_order_po_inv->DateIn->editAttributes() ?>>
<?php if (!$tbl_order_po_inv->DateIn->ReadOnly && !$tbl_order_po_inv->DateIn->Disabled && !isset($tbl_order_po_inv->DateIn->EditAttrs["readonly"]) && !isset($tbl_order_po_inv->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_order_po_invlist", "x<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_DateIn" class="form-group tbl_order_po_inv_DateIn">
<span<?php echo $tbl_order_po_inv->DateIn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->DateIn->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_DateIn" class="tbl_order_po_inv_DateIn">
<span<?php echo $tbl_order_po_inv->DateIn->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->DateIn->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In"<?php echo $tbl_order_po_inv->PCS_In->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PCS_In" class="form-group tbl_order_po_inv_PCS_In">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_In" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_In" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_In->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_In->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_In" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PCS_In" class="form-group tbl_order_po_inv_PCS_In">
<span<?php echo $tbl_order_po_inv->PCS_In->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_order_po_inv->PCS_In->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_In" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PCS_In" class="tbl_order_po_inv_PCS_In">
<span<?php echo $tbl_order_po_inv->PCS_In->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PCS_In->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PCS_Out->Visible) { // PCS_Out ?>
		<td data-name="PCS_Out"<?php echo $tbl_order_po_inv->PCS_Out->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PCS_Out" class="form-group tbl_order_po_inv_PCS_Out">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_Out" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_Out" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_Out->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_Out->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_Out" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PCS_Out" class="form-group tbl_order_po_inv_PCS_Out">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_Out" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_Out" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_Out->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_Out->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PCS_Out" class="tbl_order_po_inv_PCS_Out">
<span<?php echo $tbl_order_po_inv->PCS_Out->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PCS_Out->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_No->Visible) { // PO_No ?>
		<td data-name="PO_No"<?php echo $tbl_order_po_inv->PO_No->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PO_No" class="form-group tbl_order_po_inv_PO_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PO_No" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_No" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PO_No->EditValue ?>"<?php echo $tbl_order_po_inv->PO_No->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_No" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_No" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_No" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PO_No" class="form-group tbl_order_po_inv_PO_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PO_No" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_No" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PO_No->EditValue ?>"<?php echo $tbl_order_po_inv->PO_No->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PO_No" class="tbl_order_po_inv_PO_No">
<span<?php echo $tbl_order_po_inv->PO_No->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PO_No->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->INV_No->Visible) { // INV_No ?>
		<td data-name="INV_No"<?php echo $tbl_order_po_inv->INV_No->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_INV_No" class="form-group tbl_order_po_inv_INV_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_INV_No" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_INV_No" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_INV_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->INV_No->EditValue ?>"<?php echo $tbl_order_po_inv->INV_No->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_INV_No" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_INV_No" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_INV_No" value="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_INV_No" class="form-group tbl_order_po_inv_INV_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_INV_No" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_INV_No" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_INV_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->INV_No->EditValue ?>"<?php echo $tbl_order_po_inv->INV_No->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_INV_No" class="tbl_order_po_inv_INV_No">
<span<?php echo $tbl_order_po_inv->INV_No->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->INV_No->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_InputDate->Visible) { // PO_InputDate ?>
		<td data-name="PO_InputDate"<?php echo $tbl_order_po_inv->PO_InputDate->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputDate" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_InputDate" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_InputDate" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputDate->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PO_InputDate" class="tbl_order_po_inv_PO_InputDate">
<span<?php echo $tbl_order_po_inv->PO_InputDate->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PO_InputDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_InputUser->Visible) { // PO_InputUser ?>
		<td data-name="PO_InputUser"<?php echo $tbl_order_po_inv->PO_InputUser->cellAttributes() ?>>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputUser" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_InputUser" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_InputUser" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputUser->OldValue) ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_order_po_inv_list->RowCnt ?>_tbl_order_po_inv_PO_InputUser" class="tbl_order_po_inv_PO_InputUser">
<span<?php echo $tbl_order_po_inv->PO_InputUser->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PO_InputUser->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_order_po_inv_list->ListOptions->render("body", "right", $tbl_order_po_inv_list->RowCnt);
?>
	</tr>
<?php if ($tbl_order_po_inv->RowType == ROWTYPE_ADD || $tbl_order_po_inv->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_order_po_invlist.updateLists(<?php echo $tbl_order_po_inv_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$tbl_order_po_inv->isGridAdd())
		if (!$tbl_order_po_inv_list->Recordset->EOF)
			$tbl_order_po_inv_list->Recordset->moveNext();
}
?>
<?php
	if ($tbl_order_po_inv->isGridAdd() || $tbl_order_po_inv->isGridEdit()) {
		$tbl_order_po_inv_list->RowIndex = '$rowindex$';
		$tbl_order_po_inv_list->loadRowValues();

		// Set row properties
		$tbl_order_po_inv->resetAttributes();
		$tbl_order_po_inv->RowAttrs = array_merge($tbl_order_po_inv->RowAttrs, array('data-rowindex'=>$tbl_order_po_inv_list->RowIndex, 'id'=>'r0_tbl_order_po_inv', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($tbl_order_po_inv->RowAttrs["class"], "ew-template");
		$tbl_order_po_inv->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_order_po_inv_list->renderRow();

		// Render list options
		$tbl_order_po_inv_list->renderListOptions();
		$tbl_order_po_inv_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_order_po_inv->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_order_po_inv_list->ListOptions->render("body", "left", $tbl_order_po_inv_list->RowIndex);
?>
	<?php if ($tbl_order_po_inv->OrderNo->Visible) { // OrderNo ?>
		<td data-name="OrderNo">
<span id="el$rowindex$_tbl_order_po_inv_OrderNo" class="form-group tbl_order_po_inv_OrderNo">
<input type="text" data-table="tbl_order_po_inv" data-field="x_OrderNo" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_OrderNo" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_OrderNo" size="30" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->OrderNo->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->OrderNo->EditValue ?>"<?php echo $tbl_order_po_inv->OrderNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_OrderNo" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_OrderNo" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_OrderNo" value="<?php echo HtmlEncode($tbl_order_po_inv->OrderNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->Code->Visible) { // Code ?>
		<td data-name="Code">
<span id="el$rowindex$_tbl_order_po_inv_Code" class="form-group tbl_order_po_inv_Code">
<input type="text" data-table="tbl_order_po_inv" data-field="x_Code" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_Code" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_Code" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->Code->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->Code->EditValue ?>"<?php echo $tbl_order_po_inv->Code->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_Code" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_Code" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_Code" value="<?php echo HtmlEncode($tbl_order_po_inv->Code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PalletNo->Visible) { // PalletNo ?>
		<td data-name="PalletNo">
<span id="el$rowindex$_tbl_order_po_inv_PalletNo" class="form-group tbl_order_po_inv_PalletNo">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PalletNo" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PalletNo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PalletNo->EditValue ?>"<?php echo $tbl_order_po_inv->PalletNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PalletNo" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PalletNo" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PalletNo" value="<?php echo HtmlEncode($tbl_order_po_inv->PalletNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->DateIn->Visible) { // DateIn ?>
		<td data-name="DateIn">
<span id="el$rowindex$_tbl_order_po_inv_DateIn" class="form-group tbl_order_po_inv_DateIn">
<input type="text" data-table="tbl_order_po_inv" data-field="x_DateIn" data-format="7" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->DateIn->EditValue ?>"<?php echo $tbl_order_po_inv->DateIn->editAttributes() ?>>
<?php if (!$tbl_order_po_inv->DateIn->ReadOnly && !$tbl_order_po_inv->DateIn->Disabled && !isset($tbl_order_po_inv->DateIn->EditAttrs["readonly"]) && !isset($tbl_order_po_inv->DateIn->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftbl_order_po_invlist", "x<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_DateIn" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_DateIn" value="<?php echo HtmlEncode($tbl_order_po_inv->DateIn->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PCS_In->Visible) { // PCS_In ?>
		<td data-name="PCS_In">
<span id="el$rowindex$_tbl_order_po_inv_PCS_In" class="form-group tbl_order_po_inv_PCS_In">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_In" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_In" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_In->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_In->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_In" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_In" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_In" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_In->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PCS_Out->Visible) { // PCS_Out ?>
		<td data-name="PCS_Out">
<span id="el$rowindex$_tbl_order_po_inv_PCS_Out" class="form-group tbl_order_po_inv_PCS_Out">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_Out" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_Out" size="5" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PCS_Out->EditValue ?>"<?php echo $tbl_order_po_inv->PCS_Out->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PCS_Out" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_Out" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PCS_Out" value="<?php echo HtmlEncode($tbl_order_po_inv->PCS_Out->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_No->Visible) { // PO_No ?>
		<td data-name="PO_No">
<span id="el$rowindex$_tbl_order_po_inv_PO_No" class="form-group tbl_order_po_inv_PO_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_PO_No" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_No" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->PO_No->EditValue ?>"<?php echo $tbl_order_po_inv->PO_No->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_No" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_No" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_No" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_No->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->INV_No->Visible) { // INV_No ?>
		<td data-name="INV_No">
<span id="el$rowindex$_tbl_order_po_inv_INV_No" class="form-group tbl_order_po_inv_INV_No">
<input type="text" data-table="tbl_order_po_inv" data-field="x_INV_No" name="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_INV_No" id="x<?php echo $tbl_order_po_inv_list->RowIndex ?>_INV_No" size="20" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->getPlaceHolder()) ?>" value="<?php echo $tbl_order_po_inv->INV_No->EditValue ?>"<?php echo $tbl_order_po_inv->INV_No->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_INV_No" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_INV_No" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_INV_No" value="<?php echo HtmlEncode($tbl_order_po_inv->INV_No->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_InputDate->Visible) { // PO_InputDate ?>
		<td data-name="PO_InputDate">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputDate" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_InputDate" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_InputDate" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_order_po_inv->PO_InputUser->Visible) { // PO_InputUser ?>
		<td data-name="PO_InputUser">
<input type="hidden" data-table="tbl_order_po_inv" data-field="x_PO_InputUser" name="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_InputUser" id="o<?php echo $tbl_order_po_inv_list->RowIndex ?>_PO_InputUser" value="<?php echo HtmlEncode($tbl_order_po_inv->PO_InputUser->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_order_po_inv_list->ListOptions->render("body", "right", $tbl_order_po_inv_list->RowIndex);
?>
<script>
ftbl_order_po_invlist.updateLists(<?php echo $tbl_order_po_inv_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_order_po_inv->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_order_po_inv_list->FormKeyCountName ?>" id="<?php echo $tbl_order_po_inv_list->FormKeyCountName ?>" value="<?php echo $tbl_order_po_inv_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_order_po_inv->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $tbl_order_po_inv_list->FormKeyCountName ?>" id="<?php echo $tbl_order_po_inv_list->FormKeyCountName ?>" value="<?php echo $tbl_order_po_inv_list->KeyCount ?>">
<?php echo $tbl_order_po_inv_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$tbl_order_po_inv->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_order_po_inv_list->Recordset)
	$tbl_order_po_inv_list->Recordset->Close();
?>
<?php if (!$tbl_order_po_inv->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_order_po_inv->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_order_po_inv_list->Pager)) $tbl_order_po_inv_list->Pager = new PrevNextPager($tbl_order_po_inv_list->StartRec, $tbl_order_po_inv_list->DisplayRecs, $tbl_order_po_inv_list->TotalRecs, $tbl_order_po_inv_list->AutoHidePager) ?>
<?php if ($tbl_order_po_inv_list->Pager->RecordCount > 0 && $tbl_order_po_inv_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_order_po_inv_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_order_po_inv_list->pageUrl() ?>start=<?php echo $tbl_order_po_inv_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_order_po_inv_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_order_po_inv_list->pageUrl() ?>start=<?php echo $tbl_order_po_inv_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_order_po_inv_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_order_po_inv_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_order_po_inv_list->pageUrl() ?>start=<?php echo $tbl_order_po_inv_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_order_po_inv_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_order_po_inv_list->pageUrl() ?>start=<?php echo $tbl_order_po_inv_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_order_po_inv_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_order_po_inv_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_order_po_inv_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_order_po_inv_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_order_po_inv_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_order_po_inv_list->TotalRecs > 0 && (!$tbl_order_po_inv_list->AutoHidePageSizeSelector || $tbl_order_po_inv_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="tbl_order_po_inv">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="20"<?php if ($tbl_order_po_inv_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($tbl_order_po_inv_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($tbl_order_po_inv_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
<option value="200"<?php if ($tbl_order_po_inv_list->DisplayRecs == 200) { ?> selected<?php } ?>>200</option>
<option value="500"<?php if ($tbl_order_po_inv_list->DisplayRecs == 500) { ?> selected<?php } ?>>500</option>
<option value="ALL"<?php if ($tbl_order_po_inv->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_order_po_inv_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_order_po_inv_list->TotalRecs == 0 && !$tbl_order_po_inv->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_order_po_inv_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_order_po_inv_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_order_po_inv->isExport()) { ?>
<script>
$("[hieuung='tooltip']").tooltip();
$("#idInput").click(function(){
	var po=$("#idPO");
	var inv=$("#idINV");
	var chon=[];
	$('input[type="checkbox"]:checked').each(function() {
        chon.push($(this).val());
    });
	var dsChon="";
	for(var i=0;i<chon.length;i++)
	{
		dsChon+=chon[i]+",";
	}
	if(po.value()=="" || inv.value()=="")
	{
		alert("You must input PO And INV no for codes");
		po.focus();
		return false;
	}
	if(dsChon!="")
	{
		window.location="updatePO_INV.php?chon="+dsChon+"&po="+po.value()+"&inv="+inv.value();
	}
	else
	{
		alert("You have to input code first");
	}
	})
// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_order_po_inv_list->terminate();
?>