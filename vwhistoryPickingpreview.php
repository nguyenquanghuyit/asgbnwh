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
WriteHeader(FALSE, "utf-8");

// Create page object
$vwhistoryPicking_preview = new vwhistoryPicking_preview();

// Run the page
$vwhistoryPicking_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vwhistoryPicking_preview->Page_Render();
?>
<?php $vwhistoryPicking_preview->showPageHeader(); ?>
<div class="card ew-grid vwhistoryPicking"><!-- .card -->
<?php if ($vwhistoryPicking_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$vwhistoryPicking_preview->renderListOptions();

// Render list options (header, left)
$vwhistoryPicking_preview->ListOptions->render("header", "left");
?>
<?php if ($vwhistoryPicking->ID_His->Visible) { // ID_His ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->ID_His) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->ID_His->headerCellClass() ?>"><?php echo $vwhistoryPicking->ID_His->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->ID_His->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->ID_His->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->ID_His->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->ID_His->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->ID_His->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->PalletID->Visible) { // PalletID ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->PalletID) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->PalletID->headerCellClass() ?>"><?php echo $vwhistoryPicking->PalletID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->PalletID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->PalletID->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->PalletID->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->PalletID->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->PalletID->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->Code->Visible) { // Code ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->Code) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->Code->headerCellClass() ?>"><?php echo $vwhistoryPicking->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->Code->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->Code->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->Code->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->PCS->Visible) { // PCS ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->PCS) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->PCS->headerCellClass() ?>"><?php echo $vwhistoryPicking->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->PCS->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->PCS->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->PCS->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->Location->Visible) { // Location ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->Location) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->Location->headerCellClass() ?>"><?php echo $vwhistoryPicking->Location->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->Location->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->Location->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->Location->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->Location->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->Location->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->Box->Visible) { // Box ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->Box) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->Box->headerCellClass() ?>"><?php echo $vwhistoryPicking->Box->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->Box->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->Box->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->Box->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->Box->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->Box->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->CreateUser) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->CreateUser->headerCellClass() ?>"><?php echo $vwhistoryPicking->CreateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->CreateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->CreateUser->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->CreateUser->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->CreateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->CreateUser->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->CreateDate) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->CreateDate->headerCellClass() ?>"><?php echo $vwhistoryPicking->CreateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->CreateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->CreateDate->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->CreateDate->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->CreateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->CreateDate->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->UpdateUser) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->UpdateUser->headerCellClass() ?>"><?php echo $vwhistoryPicking->UpdateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->UpdateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->UpdateUser->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->UpdateUser->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->UpdateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->UpdateUser->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->UpdateDate->Visible) { // UpdateDate ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->UpdateDate) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->UpdateDate->headerCellClass() ?>"><?php echo $vwhistoryPicking->UpdateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->UpdateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->UpdateDate->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->UpdateDate->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->UpdateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->UpdateDate->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vwhistoryPicking->ID_Order->Visible) { // ID_Order ?>
	<?php if ($vwhistoryPicking->SortUrl($vwhistoryPicking->ID_Order) == "") { ?>
		<th class="<?php echo $vwhistoryPicking->ID_Order->headerCellClass() ?>"><?php echo $vwhistoryPicking->ID_Order->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vwhistoryPicking->ID_Order->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vwhistoryPicking->ID_Order->Name ?>" data-sort-order="<?php echo $vwhistoryPicking_preview->SortField == $vwhistoryPicking->ID_Order->Name && $vwhistoryPicking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vwhistoryPicking->ID_Order->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vwhistoryPicking_preview->SortField == $vwhistoryPicking->ID_Order->Name) { ?><?php if ($vwhistoryPicking_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vwhistoryPicking_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vwhistoryPicking_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$vwhistoryPicking_preview->RecCount = 0;
$vwhistoryPicking_preview->RowCnt = 0;
while ($vwhistoryPicking_preview->Recordset && !$vwhistoryPicking_preview->Recordset->EOF) {

	// Init row class and style
	$vwhistoryPicking_preview->RecCount++;
	$vwhistoryPicking_preview->RowCnt++;
	$vwhistoryPicking_preview->CssStyle = "";
	$vwhistoryPicking_preview->loadListRowValues($vwhistoryPicking_preview->Recordset);

	// Render row
	$vwhistoryPicking_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$vwhistoryPicking_preview->resetAttributes();
	$vwhistoryPicking_preview->renderListRow();

	// Render list options
	$vwhistoryPicking_preview->renderListOptions();
?>
	<tr<?php echo $vwhistoryPicking_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vwhistoryPicking_preview->ListOptions->render("body", "left", $vwhistoryPicking_preview->RowCnt);
?>
<?php if ($vwhistoryPicking->ID_His->Visible) { // ID_His ?>
		<!-- ID_His -->
		<td<?php echo $vwhistoryPicking->ID_His->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->ID_His->viewAttributes() ?>>
<?php echo $vwhistoryPicking->ID_His->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryPicking->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td<?php echo $vwhistoryPicking->PalletID->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->PalletID->viewAttributes() ?>>
<?php echo $vwhistoryPicking->PalletID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryPicking->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $vwhistoryPicking->Code->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->Code->viewAttributes() ?>>
<?php echo $vwhistoryPicking->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryPicking->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $vwhistoryPicking->PCS->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->PCS->viewAttributes() ?>>
<?php echo $vwhistoryPicking->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryPicking->Location->Visible) { // Location ?>
		<!-- Location -->
		<td<?php echo $vwhistoryPicking->Location->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->Location->viewAttributes() ?>>
<?php echo $vwhistoryPicking->Location->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryPicking->Box->Visible) { // Box ?>
		<!-- Box -->
		<td<?php echo $vwhistoryPicking->Box->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->Box->viewAttributes() ?>>
<?php echo $vwhistoryPicking->Box->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryPicking->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td<?php echo $vwhistoryPicking->CreateUser->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->CreateUser->viewAttributes() ?>>
<?php echo $vwhistoryPicking->CreateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryPicking->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td<?php echo $vwhistoryPicking->CreateDate->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->CreateDate->viewAttributes() ?>>
<?php echo $vwhistoryPicking->CreateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryPicking->UpdateUser->Visible) { // UpdateUser ?>
		<!-- UpdateUser -->
		<td<?php echo $vwhistoryPicking->UpdateUser->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->UpdateUser->viewAttributes() ?>>
<?php echo $vwhistoryPicking->UpdateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryPicking->UpdateDate->Visible) { // UpdateDate ?>
		<!-- UpdateDate -->
		<td<?php echo $vwhistoryPicking->UpdateDate->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->UpdateDate->viewAttributes() ?>>
<?php echo $vwhistoryPicking->UpdateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vwhistoryPicking->ID_Order->Visible) { // ID_Order ?>
		<!-- ID_Order -->
		<td<?php echo $vwhistoryPicking->ID_Order->cellAttributes() ?>>
<span<?php echo $vwhistoryPicking->ID_Order->viewAttributes() ?>>
<?php echo $vwhistoryPicking->ID_Order->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$vwhistoryPicking_preview->ListOptions->render("body", "right", $vwhistoryPicking_preview->RowCnt);
?>
	</tr>
<?php
	$vwhistoryPicking_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($vwhistoryPicking_preview->TotalRecs > 0) { ?>
<?php if (!isset($vwhistoryPicking_preview->Pager)) $vwhistoryPicking_preview->Pager = new PrevNextPager($vwhistoryPicking_preview->StartRec, $vwhistoryPicking_preview->DisplayRecs, $vwhistoryPicking_preview->TotalRecs) ?>
<?php if ($vwhistoryPicking_preview->Pager->RecordCount > 0 && $vwhistoryPicking_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($vwhistoryPicking_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $vwhistoryPicking_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($vwhistoryPicking_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $vwhistoryPicking_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($vwhistoryPicking_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $vwhistoryPicking_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($vwhistoryPicking_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $vwhistoryPicking_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vwhistoryPicking_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vwhistoryPicking_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vwhistoryPicking_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($vwhistoryPicking_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$vwhistoryPicking_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($vwhistoryPicking_preview->Recordset)
	$vwhistoryPicking_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$vwhistoryPicking_preview->terminate();
?>