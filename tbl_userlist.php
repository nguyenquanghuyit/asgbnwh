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
$tbl_user_list = new tbl_user_list();

// Run the page
$tbl_user_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_user_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tbl_user->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftbl_userlist = currentForm = new ew.Form("ftbl_userlist", "list");
ftbl_userlist.formKeyCountName = '<?php echo $tbl_user_list->FormKeyCountName ?>';

// Validate form
ftbl_userlist.validate = function() {
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
		<?php if ($tbl_user_list->ma_NV->Required) { ?>
			elm = this.getElements("x" + infix + "_ma_NV");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->ma_NV->caption(), $tbl_user->ma_NV->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_user_list->user_Name->Required) { ?>
			elm = this.getElements("x" + infix + "_user_Name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->user_Name->caption(), $tbl_user->user_Name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_user_list->pass->Required) { ?>
			elm = this.getElements("x" + infix + "_pass");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->pass->caption(), $tbl_user->pass->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_user_list->userLevel->Required) { ?>
			elm = this.getElements("x" + infix + "_userLevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->userLevel->caption(), $tbl_user->userLevel->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tbl_user_list->PB_ID->Required) { ?>
			elm = this.getElements("x" + infix + "_PB_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->PB_ID->caption(), $tbl_user->PB_ID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_PB_ID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_user->PB_ID->errorMessage()) ?>");
		<?php if ($tbl_user_list->TD_ID->Required) { ?>
			elm = this.getElements("x" + infix + "_TD_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->TD_ID->caption(), $tbl_user->TD_ID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_TD_ID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_user->TD_ID->errorMessage()) ?>");
		<?php if ($tbl_user_list->CD_ID->Required) { ?>
			elm = this.getElements("x" + infix + "_CD_ID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tbl_user->CD_ID->caption(), $tbl_user->CD_ID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CD_ID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tbl_user->CD_ID->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_userlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftbl_userlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_userlist.lists["x_userLevel"] = <?php echo $tbl_user_list->userLevel->Lookup->toClientList() ?>;
ftbl_userlist.lists["x_userLevel"].options = <?php echo JsonEncode($tbl_user_list->userLevel->lookupOptions()) ?>;

// Form object for search
var ftbl_userlistsrch = currentSearchForm = new ew.Form("ftbl_userlistsrch");

// Filters
ftbl_userlistsrch.filterList = <?php echo $tbl_user_list->getFilterList() ?>;
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
<?php if (!$tbl_user->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tbl_user_list->TotalRecs > 0 && $tbl_user_list->ExportOptions->visible()) { ?>
<?php $tbl_user_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_user_list->ImportOptions->visible()) { ?>
<?php $tbl_user_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_user_list->SearchOptions->visible()) { ?>
<?php $tbl_user_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tbl_user_list->FilterOptions->visible()) { ?>
<?php $tbl_user_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tbl_user_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tbl_user->isExport() && !$tbl_user->CurrentAction) { ?>
<form name="ftbl_userlistsrch" id="ftbl_userlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tbl_user_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftbl_userlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_user">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tbl_user_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tbl_user_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tbl_user_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tbl_user_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tbl_user_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tbl_user_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tbl_user_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_user_list->showPageHeader(); ?>
<?php
$tbl_user_list->showMessage();
?>
<?php if ($tbl_user_list->TotalRecs > 0 || $tbl_user->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tbl_user_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbl_user">
<?php if (!$tbl_user->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tbl_user->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_user_list->Pager)) $tbl_user_list->Pager = new PrevNextPager($tbl_user_list->StartRec, $tbl_user_list->DisplayRecs, $tbl_user_list->TotalRecs, $tbl_user_list->AutoHidePager) ?>
<?php if ($tbl_user_list->Pager->RecordCount > 0 && $tbl_user_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_user_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_user_list->pageUrl() ?>start=<?php echo $tbl_user_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_user_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_user_list->pageUrl() ?>start=<?php echo $tbl_user_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_user_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_user_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_user_list->pageUrl() ?>start=<?php echo $tbl_user_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_user_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_user_list->pageUrl() ?>start=<?php echo $tbl_user_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_user_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_user_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_user_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_user_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_user_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_user_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftbl_userlist" id="ftbl_userlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tbl_user_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tbl_user_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_user">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_tbl_user" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tbl_user_list->TotalRecs > 0 || $tbl_user->isAdd() || $tbl_user->isCopy() || $tbl_user->isGridEdit()) { ?>
<table id="tbl_tbl_userlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tbl_user_list->RowType = ROWTYPE_HEADER;

// Render list options
$tbl_user_list->renderListOptions();

// Render list options (header, left)
$tbl_user_list->ListOptions->render("header", "left");
?>
<?php if ($tbl_user->ma_NV->Visible) { // ma_NV ?>
	<?php if ($tbl_user->sortUrl($tbl_user->ma_NV) == "") { ?>
		<th data-name="ma_NV" class="<?php echo $tbl_user->ma_NV->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_user_ma_NV" class="tbl_user_ma_NV"><div class="ew-table-header-caption"><?php echo $tbl_user->ma_NV->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ma_NV" class="<?php echo $tbl_user->ma_NV->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->ma_NV) ?>',2);"><div id="elh_tbl_user_ma_NV" class="tbl_user_ma_NV">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_user->ma_NV->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_user->ma_NV->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_user->ma_NV->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_user->user_Name->Visible) { // user_Name ?>
	<?php if ($tbl_user->sortUrl($tbl_user->user_Name) == "") { ?>
		<th data-name="user_Name" class="<?php echo $tbl_user->user_Name->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_user_user_Name" class="tbl_user_user_Name"><div class="ew-table-header-caption"><?php echo $tbl_user->user_Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_Name" class="<?php echo $tbl_user->user_Name->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->user_Name) ?>',2);"><div id="elh_tbl_user_user_Name" class="tbl_user_user_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_user->user_Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_user->user_Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_user->user_Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_user->pass->Visible) { // pass ?>
	<?php if ($tbl_user->sortUrl($tbl_user->pass) == "") { ?>
		<th data-name="pass" class="<?php echo $tbl_user->pass->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_user_pass" class="tbl_user_pass"><div class="ew-table-header-caption"><?php echo $tbl_user->pass->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pass" class="<?php echo $tbl_user->pass->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->pass) ?>',2);"><div id="elh_tbl_user_pass" class="tbl_user_pass">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_user->pass->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tbl_user->pass->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_user->pass->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_user->userLevel->Visible) { // userLevel ?>
	<?php if ($tbl_user->sortUrl($tbl_user->userLevel) == "") { ?>
		<th data-name="userLevel" class="<?php echo $tbl_user->userLevel->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_user_userLevel" class="tbl_user_userLevel"><div class="ew-table-header-caption"><?php echo $tbl_user->userLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userLevel" class="<?php echo $tbl_user->userLevel->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->userLevel) ?>',2);"><div id="elh_tbl_user_userLevel" class="tbl_user_userLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_user->userLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_user->userLevel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_user->userLevel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_user->PB_ID->Visible) { // PB_ID ?>
	<?php if ($tbl_user->sortUrl($tbl_user->PB_ID) == "") { ?>
		<th data-name="PB_ID" class="<?php echo $tbl_user->PB_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_user_PB_ID" class="tbl_user_PB_ID"><div class="ew-table-header-caption"><?php echo $tbl_user->PB_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PB_ID" class="<?php echo $tbl_user->PB_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->PB_ID) ?>',2);"><div id="elh_tbl_user_PB_ID" class="tbl_user_PB_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_user->PB_ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_user->PB_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_user->PB_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_user->TD_ID->Visible) { // TD_ID ?>
	<?php if ($tbl_user->sortUrl($tbl_user->TD_ID) == "") { ?>
		<th data-name="TD_ID" class="<?php echo $tbl_user->TD_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_user_TD_ID" class="tbl_user_TD_ID"><div class="ew-table-header-caption"><?php echo $tbl_user->TD_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TD_ID" class="<?php echo $tbl_user->TD_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->TD_ID) ?>',2);"><div id="elh_tbl_user_TD_ID" class="tbl_user_TD_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_user->TD_ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_user->TD_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_user->TD_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_user->CD_ID->Visible) { // CD_ID ?>
	<?php if ($tbl_user->sortUrl($tbl_user->CD_ID) == "") { ?>
		<th data-name="CD_ID" class="<?php echo $tbl_user->CD_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_tbl_user_CD_ID" class="tbl_user_CD_ID"><div class="ew-table-header-caption"><?php echo $tbl_user->CD_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CD_ID" class="<?php echo $tbl_user->CD_ID->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->CD_ID) ?>',2);"><div id="elh_tbl_user_CD_ID" class="tbl_user_CD_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tbl_user->CD_ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($tbl_user->CD_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tbl_user->CD_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_user_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($tbl_user->isAdd() || $tbl_user->isCopy()) {
		$tbl_user_list->RowIndex = 0;
		$tbl_user_list->KeyCount = $tbl_user_list->RowIndex;
		if ($tbl_user->isAdd())
			$tbl_user_list->loadRowValues();
		if ($tbl_user->EventCancelled) // Insert failed
			$tbl_user_list->restoreFormValues(); // Restore form values

		// Set row properties
		$tbl_user->resetAttributes();
		$tbl_user->RowAttrs = array_merge($tbl_user->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_tbl_user', 'data-rowtype'=>ROWTYPE_ADD));
		$tbl_user->RowType = ROWTYPE_ADD;

		// Render row
		$tbl_user_list->renderRow();

		// Render list options
		$tbl_user_list->renderListOptions();
		$tbl_user_list->StartRowCnt = 0;
?>
	<tr<?php echo $tbl_user->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_user_list->ListOptions->render("body", "left", $tbl_user_list->RowCnt);
?>
	<?php if ($tbl_user->ma_NV->Visible) { // ma_NV ?>
		<td data-name="ma_NV">
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_ma_NV" class="form-group tbl_user_ma_NV">
<input type="text" data-table="tbl_user" data-field="x_ma_NV" name="x<?php echo $tbl_user_list->RowIndex ?>_ma_NV" id="x<?php echo $tbl_user_list->RowIndex ?>_ma_NV" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_user->ma_NV->getPlaceHolder()) ?>" value="<?php echo $tbl_user->ma_NV->EditValue ?>"<?php echo $tbl_user->ma_NV->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_user" data-field="x_ma_NV" name="o<?php echo $tbl_user_list->RowIndex ?>_ma_NV" id="o<?php echo $tbl_user_list->RowIndex ?>_ma_NV" value="<?php echo HtmlEncode($tbl_user->ma_NV->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_user->user_Name->Visible) { // user_Name ?>
		<td data-name="user_Name">
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_user_Name" class="form-group tbl_user_user_Name">
<input type="text" data-table="tbl_user" data-field="x_user_Name" name="x<?php echo $tbl_user_list->RowIndex ?>_user_Name" id="x<?php echo $tbl_user_list->RowIndex ?>_user_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_user->user_Name->getPlaceHolder()) ?>" value="<?php echo $tbl_user->user_Name->EditValue ?>"<?php echo $tbl_user->user_Name->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_user" data-field="x_user_Name" name="o<?php echo $tbl_user_list->RowIndex ?>_user_Name" id="o<?php echo $tbl_user_list->RowIndex ?>_user_Name" value="<?php echo HtmlEncode($tbl_user->user_Name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_user->pass->Visible) { // pass ?>
		<td data-name="pass">
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_pass" class="form-group tbl_user_pass">
<input type="text" data-table="tbl_user" data-field="x_pass" name="x<?php echo $tbl_user_list->RowIndex ?>_pass" id="x<?php echo $tbl_user_list->RowIndex ?>_pass" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_user->pass->getPlaceHolder()) ?>" value="<?php echo $tbl_user->pass->EditValue ?>"<?php echo $tbl_user->pass->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_user" data-field="x_pass" name="o<?php echo $tbl_user_list->RowIndex ?>_pass" id="o<?php echo $tbl_user_list->RowIndex ?>_pass" value="<?php echo HtmlEncode($tbl_user->pass->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_user->userLevel->Visible) { // userLevel ?>
		<td data-name="userLevel">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_userLevel" class="form-group tbl_user_userLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_user->userLevel->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_userLevel" class="form-group tbl_user_userLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_user" data-field="x_userLevel" data-value-separator="<?php echo $tbl_user->userLevel->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_user_list->RowIndex ?>_userLevel" name="x<?php echo $tbl_user_list->RowIndex ?>_userLevel"<?php echo $tbl_user->userLevel->editAttributes() ?>>
		<?php echo $tbl_user->userLevel->selectOptionListHtml("x<?php echo $tbl_user_list->RowIndex ?>_userLevel") ?>
	</select>
</div>
<?php echo $tbl_user->userLevel->Lookup->getParamTag("p_x" . $tbl_user_list->RowIndex . "_userLevel") ?>
</span>
<?php } ?>
<input type="hidden" data-table="tbl_user" data-field="x_userLevel" name="o<?php echo $tbl_user_list->RowIndex ?>_userLevel" id="o<?php echo $tbl_user_list->RowIndex ?>_userLevel" value="<?php echo HtmlEncode($tbl_user->userLevel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_user->PB_ID->Visible) { // PB_ID ?>
		<td data-name="PB_ID">
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_PB_ID" class="form-group tbl_user_PB_ID">
<input type="text" data-table="tbl_user" data-field="x_PB_ID" name="x<?php echo $tbl_user_list->RowIndex ?>_PB_ID" id="x<?php echo $tbl_user_list->RowIndex ?>_PB_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_user->PB_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_user->PB_ID->EditValue ?>"<?php echo $tbl_user->PB_ID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_user" data-field="x_PB_ID" name="o<?php echo $tbl_user_list->RowIndex ?>_PB_ID" id="o<?php echo $tbl_user_list->RowIndex ?>_PB_ID" value="<?php echo HtmlEncode($tbl_user->PB_ID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_user->TD_ID->Visible) { // TD_ID ?>
		<td data-name="TD_ID">
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_TD_ID" class="form-group tbl_user_TD_ID">
<input type="text" data-table="tbl_user" data-field="x_TD_ID" name="x<?php echo $tbl_user_list->RowIndex ?>_TD_ID" id="x<?php echo $tbl_user_list->RowIndex ?>_TD_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_user->TD_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_user->TD_ID->EditValue ?>"<?php echo $tbl_user->TD_ID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_user" data-field="x_TD_ID" name="o<?php echo $tbl_user_list->RowIndex ?>_TD_ID" id="o<?php echo $tbl_user_list->RowIndex ?>_TD_ID" value="<?php echo HtmlEncode($tbl_user->TD_ID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($tbl_user->CD_ID->Visible) { // CD_ID ?>
		<td data-name="CD_ID">
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_CD_ID" class="form-group tbl_user_CD_ID">
<input type="text" data-table="tbl_user" data-field="x_CD_ID" name="x<?php echo $tbl_user_list->RowIndex ?>_CD_ID" id="x<?php echo $tbl_user_list->RowIndex ?>_CD_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_user->CD_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_user->CD_ID->EditValue ?>"<?php echo $tbl_user->CD_ID->editAttributes() ?>>
</span>
<input type="hidden" data-table="tbl_user" data-field="x_CD_ID" name="o<?php echo $tbl_user_list->RowIndex ?>_CD_ID" id="o<?php echo $tbl_user_list->RowIndex ?>_CD_ID" value="<?php echo HtmlEncode($tbl_user->CD_ID->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_user_list->ListOptions->render("body", "right", $tbl_user_list->RowCnt);
?>
<script>
ftbl_userlist.updateLists(<?php echo $tbl_user_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($tbl_user->ExportAll && $tbl_user->isExport()) {
	$tbl_user_list->StopRec = $tbl_user_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_user_list->TotalRecs > $tbl_user_list->StartRec + $tbl_user_list->DisplayRecs - 1)
		$tbl_user_list->StopRec = $tbl_user_list->StartRec + $tbl_user_list->DisplayRecs - 1;
	else
		$tbl_user_list->StopRec = $tbl_user_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $tbl_user_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($tbl_user_list->FormKeyCountName) && ($tbl_user->isGridAdd() || $tbl_user->isGridEdit() || $tbl_user->isConfirm())) {
		$tbl_user_list->KeyCount = $CurrentForm->getValue($tbl_user_list->FormKeyCountName);
		$tbl_user_list->StopRec = $tbl_user_list->StartRec + $tbl_user_list->KeyCount - 1;
	}
}
$tbl_user_list->RecCnt = $tbl_user_list->StartRec - 1;
if ($tbl_user_list->Recordset && !$tbl_user_list->Recordset->EOF) {
	$tbl_user_list->Recordset->moveFirst();
	$selectLimit = $tbl_user_list->UseSelectLimit;
	if (!$selectLimit && $tbl_user_list->StartRec > 1)
		$tbl_user_list->Recordset->move($tbl_user_list->StartRec - 1);
} elseif (!$tbl_user->AllowAddDeleteRow && $tbl_user_list->StopRec == 0) {
	$tbl_user_list->StopRec = $tbl_user->GridAddRowCount;
}

// Initialize aggregate
$tbl_user->RowType = ROWTYPE_AGGREGATEINIT;
$tbl_user->resetAttributes();
$tbl_user_list->renderRow();
$tbl_user_list->EditRowCnt = 0;
if ($tbl_user->isEdit())
	$tbl_user_list->RowIndex = 1;
while ($tbl_user_list->RecCnt < $tbl_user_list->StopRec) {
	$tbl_user_list->RecCnt++;
	if ($tbl_user_list->RecCnt >= $tbl_user_list->StartRec) {
		$tbl_user_list->RowCnt++;

		// Set up key count
		$tbl_user_list->KeyCount = $tbl_user_list->RowIndex;

		// Init row class and style
		$tbl_user->resetAttributes();
		$tbl_user->CssClass = "";
		if ($tbl_user->isGridAdd()) {
			$tbl_user_list->loadRowValues(); // Load default values
		} else {
			$tbl_user_list->loadRowValues($tbl_user_list->Recordset); // Load row values
		}
		$tbl_user->RowType = ROWTYPE_VIEW; // Render view
		if ($tbl_user->isEdit()) {
			if ($tbl_user_list->checkInlineEditKey() && $tbl_user_list->EditRowCnt == 0) { // Inline edit
				$tbl_user->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($tbl_user->isEdit() && $tbl_user->RowType == ROWTYPE_EDIT && $tbl_user->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$tbl_user_list->restoreFormValues(); // Restore form values
		}
		if ($tbl_user->RowType == ROWTYPE_EDIT) // Edit row
			$tbl_user_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$tbl_user->RowAttrs = array_merge($tbl_user->RowAttrs, array('data-rowindex'=>$tbl_user_list->RowCnt, 'id'=>'r' . $tbl_user_list->RowCnt . '_tbl_user', 'data-rowtype'=>$tbl_user->RowType));

		// Render row
		$tbl_user_list->renderRow();

		// Render list options
		$tbl_user_list->renderListOptions();
?>
	<tr<?php echo $tbl_user->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_user_list->ListOptions->render("body", "left", $tbl_user_list->RowCnt);
?>
	<?php if ($tbl_user->ma_NV->Visible) { // ma_NV ?>
		<td data-name="ma_NV"<?php echo $tbl_user->ma_NV->cellAttributes() ?>>
<?php if ($tbl_user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_ma_NV" class="form-group tbl_user_ma_NV">
<input type="text" data-table="tbl_user" data-field="x_ma_NV" name="x<?php echo $tbl_user_list->RowIndex ?>_ma_NV" id="x<?php echo $tbl_user_list->RowIndex ?>_ma_NV" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_user->ma_NV->getPlaceHolder()) ?>" value="<?php echo $tbl_user->ma_NV->EditValue ?>"<?php echo $tbl_user->ma_NV->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_ma_NV" class="tbl_user_ma_NV">
<span<?php echo $tbl_user->ma_NV->viewAttributes() ?>>
<?php echo $tbl_user->ma_NV->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($tbl_user->RowType == ROWTYPE_EDIT || $tbl_user->CurrentMode == "edit") { ?>
<?php $tbl_user->id_User->CurrentValue = CurrentUserID(); ?>
<input type="hidden" data-table="tbl_user" data-field="x_id_User" name="x<?php echo $tbl_user_list->RowIndex ?>_id_User" id="x<?php echo $tbl_user_list->RowIndex ?>_id_User" value="<?php echo HtmlEncode($tbl_user->id_User->CurrentValue) ?>">
<?php } ?>
	<?php if ($tbl_user->user_Name->Visible) { // user_Name ?>
		<td data-name="user_Name"<?php echo $tbl_user->user_Name->cellAttributes() ?>>
<?php if ($tbl_user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_user_Name" class="form-group tbl_user_user_Name">
<input type="text" data-table="tbl_user" data-field="x_user_Name" name="x<?php echo $tbl_user_list->RowIndex ?>_user_Name" id="x<?php echo $tbl_user_list->RowIndex ?>_user_Name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_user->user_Name->getPlaceHolder()) ?>" value="<?php echo $tbl_user->user_Name->EditValue ?>"<?php echo $tbl_user->user_Name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_user_Name" class="tbl_user_user_Name">
<span<?php echo $tbl_user->user_Name->viewAttributes() ?>>
<?php echo $tbl_user->user_Name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_user->pass->Visible) { // pass ?>
		<td data-name="pass"<?php echo $tbl_user->pass->cellAttributes() ?>>
<?php if ($tbl_user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_pass" class="form-group tbl_user_pass">
<input type="text" data-table="tbl_user" data-field="x_pass" name="x<?php echo $tbl_user_list->RowIndex ?>_pass" id="x<?php echo $tbl_user_list->RowIndex ?>_pass" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tbl_user->pass->getPlaceHolder()) ?>" value="<?php echo $tbl_user->pass->EditValue ?>"<?php echo $tbl_user->pass->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_pass" class="tbl_user_pass">
<span<?php echo $tbl_user->pass->viewAttributes() ?>>
<?php echo $tbl_user->pass->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_user->userLevel->Visible) { // userLevel ?>
		<td data-name="userLevel"<?php echo $tbl_user->userLevel->cellAttributes() ?>>
<?php if ($tbl_user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_userLevel" class="form-group tbl_user_userLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tbl_user->userLevel->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_userLevel" class="form-group tbl_user_userLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="tbl_user" data-field="x_userLevel" data-value-separator="<?php echo $tbl_user->userLevel->displayValueSeparatorAttribute() ?>" id="x<?php echo $tbl_user_list->RowIndex ?>_userLevel" name="x<?php echo $tbl_user_list->RowIndex ?>_userLevel"<?php echo $tbl_user->userLevel->editAttributes() ?>>
		<?php echo $tbl_user->userLevel->selectOptionListHtml("x<?php echo $tbl_user_list->RowIndex ?>_userLevel") ?>
	</select>
</div>
<?php echo $tbl_user->userLevel->Lookup->getParamTag("p_x" . $tbl_user_list->RowIndex . "_userLevel") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($tbl_user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_userLevel" class="tbl_user_userLevel">
<span<?php echo $tbl_user->userLevel->viewAttributes() ?>>
<?php echo $tbl_user->userLevel->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_user->PB_ID->Visible) { // PB_ID ?>
		<td data-name="PB_ID"<?php echo $tbl_user->PB_ID->cellAttributes() ?>>
<?php if ($tbl_user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_PB_ID" class="form-group tbl_user_PB_ID">
<input type="text" data-table="tbl_user" data-field="x_PB_ID" name="x<?php echo $tbl_user_list->RowIndex ?>_PB_ID" id="x<?php echo $tbl_user_list->RowIndex ?>_PB_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_user->PB_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_user->PB_ID->EditValue ?>"<?php echo $tbl_user->PB_ID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_PB_ID" class="tbl_user_PB_ID">
<span<?php echo $tbl_user->PB_ID->viewAttributes() ?>>
<?php echo $tbl_user->PB_ID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_user->TD_ID->Visible) { // TD_ID ?>
		<td data-name="TD_ID"<?php echo $tbl_user->TD_ID->cellAttributes() ?>>
<?php if ($tbl_user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_TD_ID" class="form-group tbl_user_TD_ID">
<input type="text" data-table="tbl_user" data-field="x_TD_ID" name="x<?php echo $tbl_user_list->RowIndex ?>_TD_ID" id="x<?php echo $tbl_user_list->RowIndex ?>_TD_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_user->TD_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_user->TD_ID->EditValue ?>"<?php echo $tbl_user->TD_ID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_TD_ID" class="tbl_user_TD_ID">
<span<?php echo $tbl_user->TD_ID->viewAttributes() ?>>
<?php echo $tbl_user->TD_ID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_user->CD_ID->Visible) { // CD_ID ?>
		<td data-name="CD_ID"<?php echo $tbl_user->CD_ID->cellAttributes() ?>>
<?php if ($tbl_user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_CD_ID" class="form-group tbl_user_CD_ID">
<input type="text" data-table="tbl_user" data-field="x_CD_ID" name="x<?php echo $tbl_user_list->RowIndex ?>_CD_ID" id="x<?php echo $tbl_user_list->RowIndex ?>_CD_ID" size="30" placeholder="<?php echo HtmlEncode($tbl_user->CD_ID->getPlaceHolder()) ?>" value="<?php echo $tbl_user->CD_ID->EditValue ?>"<?php echo $tbl_user->CD_ID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($tbl_user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $tbl_user_list->RowCnt ?>_tbl_user_CD_ID" class="tbl_user_CD_ID">
<span<?php echo $tbl_user->CD_ID->viewAttributes() ?>>
<?php echo $tbl_user->CD_ID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_user_list->ListOptions->render("body", "right", $tbl_user_list->RowCnt);
?>
	</tr>
<?php if ($tbl_user->RowType == ROWTYPE_ADD || $tbl_user->RowType == ROWTYPE_EDIT) { ?>
<script>
ftbl_userlist.updateLists(<?php echo $tbl_user_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if (!$tbl_user->isGridAdd())
		$tbl_user_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($tbl_user->isAdd() || $tbl_user->isCopy()) { ?>
<input type="hidden" name="<?php echo $tbl_user_list->FormKeyCountName ?>" id="<?php echo $tbl_user_list->FormKeyCountName ?>" value="<?php echo $tbl_user_list->KeyCount ?>">
<?php } ?>
<?php if ($tbl_user->isEdit()) { ?>
<input type="hidden" name="<?php echo $tbl_user_list->FormKeyCountName ?>" id="<?php echo $tbl_user_list->FormKeyCountName ?>" value="<?php echo $tbl_user_list->KeyCount ?>">
<?php } ?>
<?php if (!$tbl_user->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tbl_user_list->Recordset)
	$tbl_user_list->Recordset->Close();
?>
<?php if (!$tbl_user->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tbl_user->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tbl_user_list->Pager)) $tbl_user_list->Pager = new PrevNextPager($tbl_user_list->StartRec, $tbl_user_list->DisplayRecs, $tbl_user_list->TotalRecs, $tbl_user_list->AutoHidePager) ?>
<?php if ($tbl_user_list->Pager->RecordCount > 0 && $tbl_user_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tbl_user_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tbl_user_list->pageUrl() ?>start=<?php echo $tbl_user_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tbl_user_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tbl_user_list->pageUrl() ?>start=<?php echo $tbl_user_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tbl_user_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tbl_user_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tbl_user_list->pageUrl() ?>start=<?php echo $tbl_user_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tbl_user_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tbl_user_list->pageUrl() ?>start=<?php echo $tbl_user_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_user_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tbl_user_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_user_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_user_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_user_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tbl_user_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tbl_user_list->TotalRecs == 0 && !$tbl_user->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tbl_user_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tbl_user_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tbl_user->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tbl_user_list->terminate();
?>