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
$tbl_history_pick_preview = new tbl_history_pick_preview();

// Run the page
$tbl_history_pick_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_history_pick_preview->Page_Render();
?>
<?php $tbl_history_pick_preview->showPageHeader(); ?>
<div class="card ew-grid tbl_history_pick"><!-- .card -->
<?php if ($tbl_history_pick_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$tbl_history_pick_preview->renderListOptions();

// Render list options (header, left)
$tbl_history_pick_preview->ListOptions->render("header", "left");
?>
<?php if ($tbl_history_pick->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_history_pick->SortUrl($tbl_history_pick->PalletID) == "") { ?>
		<th class="<?php echo $tbl_history_pick->PalletID->headerCellClass() ?>"><?php echo $tbl_history_pick->PalletID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_history_pick->PalletID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_history_pick->PalletID->Name ?>" data-sort-order="<?php echo $tbl_history_pick_preview->SortField == $tbl_history_pick->PalletID->Name && $tbl_history_pick_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_history_pick->PalletID->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_history_pick_preview->SortField == $tbl_history_pick->PalletID->Name) { ?><?php if ($tbl_history_pick_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_history_pick_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->Code->Visible) { // Code ?>
	<?php if ($tbl_history_pick->SortUrl($tbl_history_pick->Code) == "") { ?>
		<th class="<?php echo $tbl_history_pick->Code->headerCellClass() ?>"><?php echo $tbl_history_pick->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_history_pick->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_history_pick->Code->Name ?>" data-sort-order="<?php echo $tbl_history_pick_preview->SortField == $tbl_history_pick->Code->Name && $tbl_history_pick_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_history_pick->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_history_pick_preview->SortField == $tbl_history_pick->Code->Name) { ?><?php if ($tbl_history_pick_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_history_pick_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_history_pick->SortUrl($tbl_history_pick->ID_Location) == "") { ?>
		<th class="<?php echo $tbl_history_pick->ID_Location->headerCellClass() ?>"><?php echo $tbl_history_pick->ID_Location->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_history_pick->ID_Location->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_history_pick->ID_Location->Name ?>" data-sort-order="<?php echo $tbl_history_pick_preview->SortField == $tbl_history_pick->ID_Location->Name && $tbl_history_pick_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_history_pick->ID_Location->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_history_pick_preview->SortField == $tbl_history_pick->ID_Location->Name) { ?><?php if ($tbl_history_pick_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_history_pick_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->PCS->Visible) { // PCS ?>
	<?php if ($tbl_history_pick->SortUrl($tbl_history_pick->PCS) == "") { ?>
		<th class="<?php echo $tbl_history_pick->PCS->headerCellClass() ?>"><?php echo $tbl_history_pick->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_history_pick->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_history_pick->PCS->Name ?>" data-sort-order="<?php echo $tbl_history_pick_preview->SortField == $tbl_history_pick->PCS->Name && $tbl_history_pick_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_history_pick->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_history_pick_preview->SortField == $tbl_history_pick->PCS->Name) { ?><?php if ($tbl_history_pick_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_history_pick_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_history_pick->SortUrl($tbl_history_pick->DateIn) == "") { ?>
		<th class="<?php echo $tbl_history_pick->DateIn->headerCellClass() ?>"><?php echo $tbl_history_pick->DateIn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_history_pick->DateIn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_history_pick->DateIn->Name ?>" data-sort-order="<?php echo $tbl_history_pick_preview->SortField == $tbl_history_pick->DateIn->Name && $tbl_history_pick_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_history_pick->DateIn->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_history_pick_preview->SortField == $tbl_history_pick->DateIn->Name) { ?><?php if ($tbl_history_pick_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_history_pick_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->User_ID->Visible) { // User_ID ?>
	<?php if ($tbl_history_pick->SortUrl($tbl_history_pick->User_ID) == "") { ?>
		<th class="<?php echo $tbl_history_pick->User_ID->headerCellClass() ?>"><?php echo $tbl_history_pick->User_ID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_history_pick->User_ID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_history_pick->User_ID->Name ?>" data-sort-order="<?php echo $tbl_history_pick_preview->SortField == $tbl_history_pick->User_ID->Name && $tbl_history_pick_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_history_pick->User_ID->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_history_pick_preview->SortField == $tbl_history_pick->User_ID->Name) { ?><?php if ($tbl_history_pick_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_history_pick_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->PalletStatus->Visible) { // PalletStatus ?>
	<?php if ($tbl_history_pick->SortUrl($tbl_history_pick->PalletStatus) == "") { ?>
		<th class="<?php echo $tbl_history_pick->PalletStatus->headerCellClass() ?>"><?php echo $tbl_history_pick->PalletStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_history_pick->PalletStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_history_pick->PalletStatus->Name ?>" data-sort-order="<?php echo $tbl_history_pick_preview->SortField == $tbl_history_pick->PalletStatus->Name && $tbl_history_pick_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_history_pick->PalletStatus->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_history_pick_preview->SortField == $tbl_history_pick->PalletStatus->Name) { ?><?php if ($tbl_history_pick_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_history_pick_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_history_pick->SortUrl($tbl_history_pick->CreateUser) == "") { ?>
		<th class="<?php echo $tbl_history_pick->CreateUser->headerCellClass() ?>"><?php echo $tbl_history_pick->CreateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_history_pick->CreateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_history_pick->CreateUser->Name ?>" data-sort-order="<?php echo $tbl_history_pick_preview->SortField == $tbl_history_pick->CreateUser->Name && $tbl_history_pick_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_history_pick->CreateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_history_pick_preview->SortField == $tbl_history_pick->CreateUser->Name) { ?><?php if ($tbl_history_pick_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_history_pick_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_history_pick->SortUrl($tbl_history_pick->CreateDate) == "") { ?>
		<th class="<?php echo $tbl_history_pick->CreateDate->headerCellClass() ?>"><?php echo $tbl_history_pick->CreateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_history_pick->CreateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_history_pick->CreateDate->Name ?>" data-sort-order="<?php echo $tbl_history_pick_preview->SortField == $tbl_history_pick->CreateDate->Name && $tbl_history_pick_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_history_pick->CreateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_history_pick_preview->SortField == $tbl_history_pick->CreateDate->Name) { ?><?php if ($tbl_history_pick_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_history_pick_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_history_pick->Box->Visible) { // Box ?>
	<?php if ($tbl_history_pick->SortUrl($tbl_history_pick->Box) == "") { ?>
		<th class="<?php echo $tbl_history_pick->Box->headerCellClass() ?>"><?php echo $tbl_history_pick->Box->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_history_pick->Box->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_history_pick->Box->Name ?>" data-sort-order="<?php echo $tbl_history_pick_preview->SortField == $tbl_history_pick->Box->Name && $tbl_history_pick_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_history_pick->Box->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_history_pick_preview->SortField == $tbl_history_pick->Box->Name) { ?><?php if ($tbl_history_pick_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_history_pick_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_history_pick_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_history_pick_preview->RecCount = 0;
$tbl_history_pick_preview->RowCnt = 0;
while ($tbl_history_pick_preview->Recordset && !$tbl_history_pick_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_history_pick_preview->RecCount++;
	$tbl_history_pick_preview->RowCnt++;
	$tbl_history_pick_preview->CssStyle = "";
	$tbl_history_pick_preview->loadListRowValues($tbl_history_pick_preview->Recordset);
	$tbl_history_pick_preview->aggregateListRowValues(); // Aggregate row values

	// Render row
	$tbl_history_pick_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$tbl_history_pick_preview->resetAttributes();
	$tbl_history_pick_preview->renderListRow();

	// Render list options
	$tbl_history_pick_preview->renderListOptions();
?>
	<tr<?php echo $tbl_history_pick_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_history_pick_preview->ListOptions->render("body", "left", $tbl_history_pick_preview->RowCnt);
?>
<?php if ($tbl_history_pick->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td<?php echo $tbl_history_pick->PalletID->cellAttributes() ?>>
<span<?php echo $tbl_history_pick->PalletID->viewAttributes() ?>>
<?php echo $tbl_history_pick->PalletID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_history_pick->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $tbl_history_pick->Code->cellAttributes() ?>>
<span<?php echo $tbl_history_pick->Code->viewAttributes() ?>>
<?php echo $tbl_history_pick->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_history_pick->ID_Location->Visible) { // ID_Location ?>
		<!-- ID_Location -->
		<td<?php echo $tbl_history_pick->ID_Location->cellAttributes() ?>>
<span<?php echo $tbl_history_pick->ID_Location->viewAttributes() ?>>
<?php echo $tbl_history_pick->ID_Location->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_history_pick->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $tbl_history_pick->PCS->cellAttributes() ?>>
<span<?php echo $tbl_history_pick->PCS->viewAttributes() ?>>
<?php echo $tbl_history_pick->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_history_pick->DateIn->Visible) { // DateIn ?>
		<!-- DateIn -->
		<td<?php echo $tbl_history_pick->DateIn->cellAttributes() ?>>
<span<?php echo $tbl_history_pick->DateIn->viewAttributes() ?>>
<?php echo $tbl_history_pick->DateIn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_history_pick->User_ID->Visible) { // User_ID ?>
		<!-- User_ID -->
		<td<?php echo $tbl_history_pick->User_ID->cellAttributes() ?>>
<span<?php echo $tbl_history_pick->User_ID->viewAttributes() ?>>
<?php echo $tbl_history_pick->User_ID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_history_pick->PalletStatus->Visible) { // PalletStatus ?>
		<!-- PalletStatus -->
		<td<?php echo $tbl_history_pick->PalletStatus->cellAttributes() ?>>
<span<?php echo $tbl_history_pick->PalletStatus->viewAttributes() ?>>
<?php echo $tbl_history_pick->PalletStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_history_pick->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td<?php echo $tbl_history_pick->CreateUser->cellAttributes() ?>>
<span<?php echo $tbl_history_pick->CreateUser->viewAttributes() ?>>
<?php echo $tbl_history_pick->CreateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_history_pick->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td<?php echo $tbl_history_pick->CreateDate->cellAttributes() ?>>
<span<?php echo $tbl_history_pick->CreateDate->viewAttributes() ?>>
<?php echo $tbl_history_pick->CreateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_history_pick->Box->Visible) { // Box ?>
		<!-- Box -->
		<td<?php echo $tbl_history_pick->Box->cellAttributes() ?>>
<span<?php echo $tbl_history_pick->Box->viewAttributes() ?>>
<?php echo $tbl_history_pick->Box->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_history_pick_preview->ListOptions->render("body", "right", $tbl_history_pick_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_history_pick_preview->Recordset->MoveNext();
}
?>
	</tbody>
<?php

	// Render aggregate row
	$tbl_history_pick_preview->aggregateListRow(); // Prepare aggregate row

	// Render list options
	$tbl_history_pick_preview->renderListOptions();
?>
	<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options (footer, left)
$tbl_history_pick_preview->ListOptions->render("footer", "left");
?>
<?php if ($tbl_history_pick->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td class="<?php echo $tbl_history_pick->PalletID->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_history_pick->Code->Visible) { // Code ?>
		<!-- Code -->
		<td class="<?php echo $tbl_history_pick->Code->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_history_pick->ID_Location->Visible) { // ID_Location ?>
		<!-- ID_Location -->
		<td class="<?php echo $tbl_history_pick->ID_Location->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_history_pick->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td class="<?php echo $tbl_history_pick->PCS->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_history_pick->PCS->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($tbl_history_pick->DateIn->Visible) { // DateIn ?>
		<!-- DateIn -->
		<td class="<?php echo $tbl_history_pick->DateIn->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_history_pick->User_ID->Visible) { // User_ID ?>
		<!-- User_ID -->
		<td class="<?php echo $tbl_history_pick->User_ID->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_history_pick->PalletStatus->Visible) { // PalletStatus ?>
		<!-- PalletStatus -->
		<td class="<?php echo $tbl_history_pick->PalletStatus->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_history_pick->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td class="<?php echo $tbl_history_pick->CreateUser->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_history_pick->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td class="<?php echo $tbl_history_pick->CreateDate->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_history_pick->Box->Visible) { // Box ?>
		<!-- Box -->
		<td class="<?php echo $tbl_history_pick->Box->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_history_pick->Box->ViewValue ?></span>
		</td>
<?php } ?>
<?php

// Render list options (footer, right)
$tbl_history_pick_preview->ListOptions->render("footer", "right");
?>
	</tr>
	</tfoot>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($tbl_history_pick_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_history_pick_preview->Pager)) $tbl_history_pick_preview->Pager = new PrevNextPager($tbl_history_pick_preview->StartRec, $tbl_history_pick_preview->DisplayRecs, $tbl_history_pick_preview->TotalRecs) ?>
<?php if ($tbl_history_pick_preview->Pager->RecordCount > 0 && $tbl_history_pick_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($tbl_history_pick_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_history_pick_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_history_pick_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_history_pick_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_history_pick_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_history_pick_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_history_pick_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_history_pick_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_history_pick_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_history_pick_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_history_pick_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($tbl_history_pick_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$tbl_history_pick_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($tbl_history_pick_preview->Recordset)
	$tbl_history_pick_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$tbl_history_pick_preview->terminate();
?>