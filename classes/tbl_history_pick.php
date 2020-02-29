<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for tbl_history_pick
 */
class tbl_history_pick extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $ID_His;
	public $PalletID;
	public $Code;
	public $ID_Location;
	public $PCS;
	public $DateIn;
	public $User_ID;
	public $PalletStatus;
	public $CreateUser;
	public $CreateDate;
	public $UpdateUser;
	public $UpdateDate;
	public $ID_Stock;
	public $Imp_Id;
	public $ID_Order;
	public $Box;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tbl_history_pick';
		$this->TableName = 'tbl_history_pick';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_history_pick`";
		$this->Dbid = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 8;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ID_His
		$this->ID_His = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_ID_His', 'ID_His', '`ID_His`', '`ID_His`', 3, -1, FALSE, '`ID_His`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID_His->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID_His->IsPrimaryKey = TRUE; // Primary key field
		$this->ID_His->Sortable = FALSE; // Allow sort
		$this->ID_His->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_His'] = &$this->ID_His;

		// PalletID
		$this->PalletID = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_PalletID', 'PalletID', '`PalletID`', '`PalletID`', 200, -1, FALSE, '`PalletID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PalletID->Sortable = TRUE; // Allow sort
		$this->fields['PalletID'] = &$this->PalletID;

		// Code
		$this->Code = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_Code', 'Code', '`Code`', '`Code`', 200, -1, FALSE, '`Code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Code->Sortable = TRUE; // Allow sort
		$this->fields['Code'] = &$this->Code;

		// ID_Location
		$this->ID_Location = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_ID_Location', 'ID_Location', '`ID_Location`', '`ID_Location`', 3, -1, FALSE, '`ID_Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Location->Sortable = TRUE; // Allow sort
		$this->ID_Location->Lookup = new Lookup('ID_Location', 'tbl_location', FALSE, 'ID_Location', ["Location","","",""], [], [], [], [], [], [], '', '');
		$this->ID_Location->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Location'] = &$this->ID_Location;

		// PCS
		$this->PCS = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_PCS', 'PCS', '`PCS`', '`PCS`', 3, -1, FALSE, '`PCS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PCS->Sortable = TRUE; // Allow sort
		$this->PCS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PCS'] = &$this->PCS;

		// DateIn
		$this->DateIn = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_DateIn', 'DateIn', '`DateIn`', CastDateFieldForLike('`DateIn`', 7, "DB"), 135, 7, FALSE, '`DateIn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateIn->Sortable = FALSE; // Allow sort
		$this->DateIn->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['DateIn'] = &$this->DateIn;

		// User_ID
		$this->User_ID = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_User_ID', 'User_ID', '`User_ID`', '`User_ID`', 200, -1, FALSE, '`User_ID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->User_ID->Sortable = FALSE; // Allow sort
		$this->fields['User_ID'] = &$this->User_ID;

		// PalletStatus
		$this->PalletStatus = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_PalletStatus', 'PalletStatus', '`PalletStatus`', '`PalletStatus`', 200, -1, FALSE, '`PalletStatus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PalletStatus->Sortable = TRUE; // Allow sort
		$this->fields['PalletStatus'] = &$this->PalletStatus;

		// CreateUser
		$this->CreateUser = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_CreateUser', 'CreateUser', '`CreateUser`', '`CreateUser`', 200, -1, FALSE, '`CreateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateUser->Sortable = TRUE; // Allow sort
		$this->fields['CreateUser'] = &$this->CreateUser;

		// CreateDate
		$this->CreateDate = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_CreateDate', 'CreateDate', '`CreateDate`', CastDateFieldForLike('`CreateDate`', 0, "DB"), 135, 0, FALSE, '`CreateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateDate->Sortable = TRUE; // Allow sort
		$this->CreateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['CreateDate'] = &$this->CreateDate;

		// UpdateUser
		$this->UpdateUser = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_UpdateUser', 'UpdateUser', '`UpdateUser`', '`UpdateUser`', 200, -1, FALSE, '`UpdateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateUser->Sortable = FALSE; // Allow sort
		$this->fields['UpdateUser'] = &$this->UpdateUser;

		// UpdateDate
		$this->UpdateDate = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_UpdateDate', 'UpdateDate', '`UpdateDate`', CastDateFieldForLike('`UpdateDate`', 0, "DB"), 135, 0, FALSE, '`UpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateDate->Sortable = FALSE; // Allow sort
		$this->UpdateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['UpdateDate'] = &$this->UpdateDate;

		// ID_Stock
		$this->ID_Stock = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_ID_Stock', 'ID_Stock', '`ID_Stock`', '`ID_Stock`', 3, -1, FALSE, '`ID_Stock`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Stock->Sortable = FALSE; // Allow sort
		$this->ID_Stock->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Stock'] = &$this->ID_Stock;

		// Imp_Id
		$this->Imp_Id = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_Imp_Id', 'Imp_Id', '`Imp_Id`', '`Imp_Id`', 200, -1, FALSE, '`Imp_Id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Imp_Id->Sortable = FALSE; // Allow sort
		$this->fields['Imp_Id'] = &$this->Imp_Id;

		// ID_Order
		$this->ID_Order = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_ID_Order', 'ID_Order', '`ID_Order`', '`ID_Order`', 3, -1, FALSE, '`ID_Order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Order->IsForeignKey = TRUE; // Foreign key field
		$this->ID_Order->Sortable = FALSE; // Allow sort
		$this->ID_Order->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Order'] = &$this->ID_Order;

		// Box
		$this->Box = new DbField('tbl_history_pick', 'tbl_history_pick', 'x_Box', 'Box', '`Box`', '`Box`', 3, -1, FALSE, '`Box`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Box->Sortable = TRUE; // Allow sort
		$this->Box->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Box'] = &$this->Box;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Multiple column sort
	public function updateSort(&$fld, $ctrl)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($ctrl) {
				$orderBy = $this->getSessionOrderBy();
				if (ContainsString($orderBy, $sortField . " " . $lastSort)) {
					$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
				} else {
					if ($orderBy <> "")
						$orderBy .= ", ";
					$orderBy .= $sortField . " " . $thisSort;
				}
				$this->setSessionOrderBy($orderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_MASTER_TABLE];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "vwpickingbyorder") {
			if ($this->ID_Order->getSessionValue() <> "")
				$masterFilter .= "`ID_Order`=" . QuotedValue($this->ID_Order->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "vwpickingbyorder") {
			if ($this->ID_Order->getSessionValue() <> "")
				$detailFilter .= "`ID_Order`=" . QuotedValue($this->ID_Order->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_vwpickingbyorder()
	{
		return "`ID_Order`=@ID_Order@";
	}

	// Detail filter
	public function sqlDetailFilter_vwpickingbyorder()
	{
		return "`ID_Order`=@ID_Order@";
	}

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_DETAIL_TABLE];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "tbl_order") {
			$detailUrl = $GLOBALS["tbl_order"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_ID_Order=" . urlencode($this->ID_Order->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "tbl_history_picklist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`tbl_history_pick`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "`CreateDate` DESC,`PalletID` ASC,`Code` ASC";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->ID_His->setDbValue($conn->insert_ID());
			$rs['ID_His'] = $this->ID_His->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();

		// Cascade Update detail table 'tbl_order'
		$cascadeUpdate = FALSE;
		$rscascade = array();
		if ($rsold && (isset($rs['ID_Order']) && $rsold['ID_Order'] <> $rs['ID_Order'])) { // Update detail field 'ID_Order'
			$cascadeUpdate = TRUE;
			$rscascade['ID_Order'] = $rs['ID_Order']; 
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["tbl_order"]))
				$GLOBALS["tbl_order"] = new tbl_order();
			$rswrk = $GLOBALS["tbl_order"]->loadRs("`ID_Order` = " . QuotedValue($rsold['ID_Order'], DATATYPE_NUMBER, 'DB')); 
			while ($rswrk && !$rswrk->EOF) {
				$rskey = array();
				$fldname = 'ID_Order';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["tbl_order"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["tbl_order"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["tbl_order"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'ID_His';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ID_His', $rs))
				AddFilter($where, QuotedName('ID_His', $this->Dbid) . '=' . QuotedValue($rs['ID_His'], $this->ID_His->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();

		// Cascade delete detail table 'tbl_order'
		if (!isset($GLOBALS["tbl_order"]))
			$GLOBALS["tbl_order"] = new tbl_order();
		$rscascade = $GLOBALS["tbl_order"]->loadRs("`ID_Order` = " . QuotedValue($rs['ID_Order'], DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->getRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["tbl_order"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["tbl_order"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["tbl_order"]->Row_Deleted($dtlrow);
		}
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ID_His->DbValue = $row['ID_His'];
		$this->PalletID->DbValue = $row['PalletID'];
		$this->Code->DbValue = $row['Code'];
		$this->ID_Location->DbValue = $row['ID_Location'];
		$this->PCS->DbValue = $row['PCS'];
		$this->DateIn->DbValue = $row['DateIn'];
		$this->User_ID->DbValue = $row['User_ID'];
		$this->PalletStatus->DbValue = $row['PalletStatus'];
		$this->CreateUser->DbValue = $row['CreateUser'];
		$this->CreateDate->DbValue = $row['CreateDate'];
		$this->UpdateUser->DbValue = $row['UpdateUser'];
		$this->UpdateDate->DbValue = $row['UpdateDate'];
		$this->ID_Stock->DbValue = $row['ID_Stock'];
		$this->Imp_Id->DbValue = $row['Imp_Id'];
		$this->ID_Order->DbValue = $row['ID_Order'];
		$this->Box->DbValue = $row['Box'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID_His` = @ID_His@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('ID_His', $row) ? $row['ID_His'] : NULL) : $this->ID_His->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID_His@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "tbl_history_picklist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "tbl_history_pickview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_history_pickedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_history_pickadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_history_picklist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("tbl_history_pickview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_history_pickview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "tbl_history_pickadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_history_pickadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("tbl_history_pickedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_history_pickedit.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("tbl_history_pickadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_history_pickadd.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("tbl_history_pickdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "vwpickingbyorder" && !ContainsString($url, TABLE_SHOW_MASTER . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ID_Order=" . urlencode($this->ID_Order->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID_His:" . JsonEncode($this->ID_His->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->ID_His->CurrentValue != NULL) {
			$url .= "ID_His=" . urlencode($this->ID_His->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("ID_His") !== NULL)
				$arKeys[] = Param("ID_His");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->ID_His->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->ID_His->setDbValue($rs->fields('ID_His'));
		$this->PalletID->setDbValue($rs->fields('PalletID'));
		$this->Code->setDbValue($rs->fields('Code'));
		$this->ID_Location->setDbValue($rs->fields('ID_Location'));
		$this->PCS->setDbValue($rs->fields('PCS'));
		$this->DateIn->setDbValue($rs->fields('DateIn'));
		$this->User_ID->setDbValue($rs->fields('User_ID'));
		$this->PalletStatus->setDbValue($rs->fields('PalletStatus'));
		$this->CreateUser->setDbValue($rs->fields('CreateUser'));
		$this->CreateDate->setDbValue($rs->fields('CreateDate'));
		$this->UpdateUser->setDbValue($rs->fields('UpdateUser'));
		$this->UpdateDate->setDbValue($rs->fields('UpdateDate'));
		$this->ID_Stock->setDbValue($rs->fields('ID_Stock'));
		$this->Imp_Id->setDbValue($rs->fields('Imp_Id'));
		$this->ID_Order->setDbValue($rs->fields('ID_Order'));
		$this->Box->setDbValue($rs->fields('Box'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID_His

		$this->ID_His->CellCssStyle = "white-space: nowrap;";

		// PalletID
		$this->PalletID->CellCssStyle = "white-space: nowrap;";

		// Code
		$this->Code->CellCssStyle = "white-space: nowrap;";

		// ID_Location
		$this->ID_Location->CellCssStyle = "white-space: nowrap;";

		// PCS
		$this->PCS->CellCssStyle = "white-space: nowrap;";

		// DateIn
		$this->DateIn->CellCssStyle = "white-space: nowrap;";

		// User_ID
		$this->User_ID->CellCssStyle = "white-space: nowrap;";

		// PalletStatus
		$this->PalletStatus->CellCssStyle = "white-space: nowrap;";

		// CreateUser
		$this->CreateUser->CellCssStyle = "white-space: nowrap;";

		// CreateDate
		$this->CreateDate->CellCssStyle = "white-space: nowrap;";

		// UpdateUser
		$this->UpdateUser->CellCssStyle = "white-space: nowrap;";

		// UpdateDate
		$this->UpdateDate->CellCssStyle = "white-space: nowrap;";

		// ID_Stock
		$this->ID_Stock->CellCssStyle = "white-space: nowrap;";

		// Imp_Id
		$this->Imp_Id->CellCssStyle = "white-space: nowrap;";

		// ID_Order
		$this->ID_Order->CellCssStyle = "white-space: nowrap;";

		// Box
		$this->Box->CellCssStyle = "white-space: nowrap;";

		// ID_His
		$this->ID_His->ViewValue = $this->ID_His->CurrentValue;
		$this->ID_His->ViewCustomAttributes = "";

		// PalletID
		$this->PalletID->ViewValue = $this->PalletID->CurrentValue;
		$this->PalletID->ViewCustomAttributes = "";

		// Code
		$this->Code->ViewValue = $this->Code->CurrentValue;
		$this->Code->ViewCustomAttributes = "";

		// ID_Location
		$this->ID_Location->ViewValue = $this->ID_Location->CurrentValue;
		$curVal = strval($this->ID_Location->CurrentValue);
		if ($curVal <> "") {
			$this->ID_Location->ViewValue = $this->ID_Location->lookupCacheOption($curVal);
			if ($this->ID_Location->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ID_Location`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ID_Location->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->ID_Location->ViewValue = $this->ID_Location->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ID_Location->ViewValue = $this->ID_Location->CurrentValue;
				}
			}
		} else {
			$this->ID_Location->ViewValue = NULL;
		}
		$this->ID_Location->ViewCustomAttributes = "";

		// PCS
		$this->PCS->ViewValue = $this->PCS->CurrentValue;
		$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
		$this->PCS->CellCssStyle .= "text-align: right;";
		$this->PCS->ViewCustomAttributes = "";

		// DateIn
		$this->DateIn->ViewValue = $this->DateIn->CurrentValue;
		$this->DateIn->ViewValue = FormatDateTime($this->DateIn->ViewValue, 7);
		$this->DateIn->CellCssStyle .= "text-align: center;";
		$this->DateIn->ViewCustomAttributes = "";

		// User_ID
		$this->User_ID->ViewValue = $this->User_ID->CurrentValue;
		$this->User_ID->ViewCustomAttributes = "";

		// PalletStatus
		$this->PalletStatus->ViewValue = $this->PalletStatus->CurrentValue;
		$this->PalletStatus->CellCssStyle .= "text-align: center;";
		$this->PalletStatus->ViewCustomAttributes = "";

		// CreateUser
		$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->ViewCustomAttributes = "";

		// CreateDate
		$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
		$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 0);
		$this->CreateDate->ViewCustomAttributes = "";

		// UpdateUser
		$this->UpdateUser->ViewValue = $this->UpdateUser->CurrentValue;
		$this->UpdateUser->ViewCustomAttributes = "";

		// UpdateDate
		$this->UpdateDate->ViewValue = $this->UpdateDate->CurrentValue;
		$this->UpdateDate->ViewValue = FormatDateTime($this->UpdateDate->ViewValue, 0);
		$this->UpdateDate->ViewCustomAttributes = "";

		// ID_Stock
		$this->ID_Stock->ViewValue = $this->ID_Stock->CurrentValue;
		$this->ID_Stock->ViewValue = FormatNumber($this->ID_Stock->ViewValue, 0, -2, -2, -2);
		$this->ID_Stock->ViewCustomAttributes = "";

		// Imp_Id
		$this->Imp_Id->ViewValue = $this->Imp_Id->CurrentValue;
		$this->Imp_Id->ViewCustomAttributes = "";

		// ID_Order
		$this->ID_Order->ViewValue = $this->ID_Order->CurrentValue;
		$this->ID_Order->ViewValue = FormatNumber($this->ID_Order->ViewValue, 0, -2, -2, -2);
		$this->ID_Order->ViewCustomAttributes = "";

		// Box
		$this->Box->ViewValue = $this->Box->CurrentValue;
		$this->Box->ViewValue = FormatNumber($this->Box->ViewValue, 0, -2, -2, -2);
		$this->Box->CellCssStyle .= "text-align: right;";
		$this->Box->ViewCustomAttributes = "";

		// ID_His
		$this->ID_His->LinkCustomAttributes = "";
		$this->ID_His->HrefValue = "";
		$this->ID_His->TooltipValue = "";

		// PalletID
		$this->PalletID->LinkCustomAttributes = "";
		$this->PalletID->HrefValue = "";
		$this->PalletID->TooltipValue = "";

		// Code
		$this->Code->LinkCustomAttributes = "";
		$this->Code->HrefValue = "";
		$this->Code->TooltipValue = "";

		// ID_Location
		$this->ID_Location->LinkCustomAttributes = "";
		$this->ID_Location->HrefValue = "";
		$this->ID_Location->TooltipValue = "";

		// PCS
		$this->PCS->LinkCustomAttributes = "";
		$this->PCS->HrefValue = "";
		$this->PCS->TooltipValue = "";

		// DateIn
		$this->DateIn->LinkCustomAttributes = "";
		$this->DateIn->HrefValue = "";
		$this->DateIn->TooltipValue = "";

		// User_ID
		$this->User_ID->LinkCustomAttributes = "";
		$this->User_ID->HrefValue = "";
		$this->User_ID->TooltipValue = "";

		// PalletStatus
		$this->PalletStatus->LinkCustomAttributes = "";
		$this->PalletStatus->HrefValue = "";
		$this->PalletStatus->TooltipValue = "";

		// CreateUser
		$this->CreateUser->LinkCustomAttributes = "";
		$this->CreateUser->HrefValue = "";
		$this->CreateUser->TooltipValue = "";

		// CreateDate
		$this->CreateDate->LinkCustomAttributes = "";
		$this->CreateDate->HrefValue = "";
		$this->CreateDate->TooltipValue = "";

		// UpdateUser
		$this->UpdateUser->LinkCustomAttributes = "";
		$this->UpdateUser->HrefValue = "";
		$this->UpdateUser->TooltipValue = "";

		// UpdateDate
		$this->UpdateDate->LinkCustomAttributes = "";
		$this->UpdateDate->HrefValue = "";
		$this->UpdateDate->TooltipValue = "";

		// ID_Stock
		$this->ID_Stock->LinkCustomAttributes = "";
		$this->ID_Stock->HrefValue = "";
		$this->ID_Stock->TooltipValue = "";

		// Imp_Id
		$this->Imp_Id->LinkCustomAttributes = "";
		$this->Imp_Id->HrefValue = "";
		$this->Imp_Id->TooltipValue = "";

		// ID_Order
		$this->ID_Order->LinkCustomAttributes = "";
		$this->ID_Order->HrefValue = "";
		$this->ID_Order->TooltipValue = "";

		// Box
		$this->Box->LinkCustomAttributes = "";
		$this->Box->HrefValue = "";
		$this->Box->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// ID_His
		$this->ID_His->EditAttrs["class"] = "form-control";
		$this->ID_His->EditCustomAttributes = "";
		$this->ID_His->EditValue = $this->ID_His->CurrentValue;
		$this->ID_His->ViewCustomAttributes = "";

		// PalletID
		$this->PalletID->EditAttrs["class"] = "form-control";
		$this->PalletID->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->PalletID->CurrentValue = HtmlDecode($this->PalletID->CurrentValue);
		$this->PalletID->EditValue = $this->PalletID->CurrentValue;
		$this->PalletID->PlaceHolder = RemoveHtml($this->PalletID->caption());

		// Code
		$this->Code->EditAttrs["class"] = "form-control";
		$this->Code->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
		$this->Code->EditValue = $this->Code->CurrentValue;
		$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

		// ID_Location
		$this->ID_Location->EditAttrs["class"] = "form-control";
		$this->ID_Location->EditCustomAttributes = "";
		$this->ID_Location->EditValue = $this->ID_Location->CurrentValue;
		$this->ID_Location->PlaceHolder = RemoveHtml($this->ID_Location->caption());

		// PCS
		$this->PCS->EditAttrs["class"] = "form-control";
		$this->PCS->EditCustomAttributes = "";
		$this->PCS->EditValue = $this->PCS->CurrentValue;
		$this->PCS->PlaceHolder = RemoveHtml($this->PCS->caption());

		// DateIn
		$this->DateIn->EditAttrs["class"] = "form-control";
		$this->DateIn->EditCustomAttributes = "";
		$this->DateIn->EditValue = FormatDateTime($this->DateIn->CurrentValue, 7);
		$this->DateIn->PlaceHolder = RemoveHtml($this->DateIn->caption());

		// User_ID
		$this->User_ID->EditAttrs["class"] = "form-control";
		$this->User_ID->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->User_ID->CurrentValue = HtmlDecode($this->User_ID->CurrentValue);
		$this->User_ID->EditValue = $this->User_ID->CurrentValue;
		$this->User_ID->PlaceHolder = RemoveHtml($this->User_ID->caption());

		// PalletStatus
		$this->PalletStatus->EditAttrs["class"] = "form-control";
		$this->PalletStatus->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->PalletStatus->CurrentValue = HtmlDecode($this->PalletStatus->CurrentValue);
		$this->PalletStatus->EditValue = $this->PalletStatus->CurrentValue;
		$this->PalletStatus->PlaceHolder = RemoveHtml($this->PalletStatus->caption());

		// CreateUser
		$this->CreateUser->EditAttrs["class"] = "form-control";
		$this->CreateUser->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->CreateUser->CurrentValue = HtmlDecode($this->CreateUser->CurrentValue);
		$this->CreateUser->EditValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->PlaceHolder = RemoveHtml($this->CreateUser->caption());

		// CreateDate
		$this->CreateDate->EditAttrs["class"] = "form-control";
		$this->CreateDate->EditCustomAttributes = "";
		$this->CreateDate->EditValue = FormatDateTime($this->CreateDate->CurrentValue, 8);
		$this->CreateDate->PlaceHolder = RemoveHtml($this->CreateDate->caption());

		// UpdateUser
		$this->UpdateUser->EditAttrs["class"] = "form-control";
		$this->UpdateUser->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->UpdateUser->CurrentValue = HtmlDecode($this->UpdateUser->CurrentValue);
		$this->UpdateUser->EditValue = $this->UpdateUser->CurrentValue;
		$this->UpdateUser->PlaceHolder = RemoveHtml($this->UpdateUser->caption());

		// UpdateDate
		$this->UpdateDate->EditAttrs["class"] = "form-control";
		$this->UpdateDate->EditCustomAttributes = "";
		$this->UpdateDate->EditValue = FormatDateTime($this->UpdateDate->CurrentValue, 8);
		$this->UpdateDate->PlaceHolder = RemoveHtml($this->UpdateDate->caption());

		// ID_Stock
		$this->ID_Stock->EditAttrs["class"] = "form-control";
		$this->ID_Stock->EditCustomAttributes = "";
		$this->ID_Stock->EditValue = $this->ID_Stock->CurrentValue;
		$this->ID_Stock->PlaceHolder = RemoveHtml($this->ID_Stock->caption());

		// Imp_Id
		$this->Imp_Id->EditAttrs["class"] = "form-control";
		$this->Imp_Id->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Imp_Id->CurrentValue = HtmlDecode($this->Imp_Id->CurrentValue);
		$this->Imp_Id->EditValue = $this->Imp_Id->CurrentValue;
		$this->Imp_Id->PlaceHolder = RemoveHtml($this->Imp_Id->caption());

		// ID_Order
		$this->ID_Order->EditAttrs["class"] = "form-control";
		$this->ID_Order->EditCustomAttributes = "";
		if ($this->ID_Order->getSessionValue() <> "") {
			$this->ID_Order->CurrentValue = $this->ID_Order->getSessionValue();
		$this->ID_Order->ViewValue = $this->ID_Order->CurrentValue;
		$this->ID_Order->ViewValue = FormatNumber($this->ID_Order->ViewValue, 0, -2, -2, -2);
		$this->ID_Order->ViewCustomAttributes = "";
		} else {
		$this->ID_Order->EditValue = $this->ID_Order->CurrentValue;
		$this->ID_Order->PlaceHolder = RemoveHtml($this->ID_Order->caption());
		}

		// Box
		$this->Box->EditAttrs["class"] = "form-control";
		$this->Box->EditCustomAttributes = "";
		$this->Box->EditValue = $this->Box->CurrentValue;
		$this->Box->PlaceHolder = RemoveHtml($this->Box->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->PCS->CurrentValue))
				$this->PCS->Total += $this->PCS->CurrentValue; // Accumulate total
			if (is_numeric($this->Box->CurrentValue))
				$this->Box->Total += $this->Box->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->PCS->CurrentValue = $this->PCS->Total;
			$this->PCS->ViewValue = $this->PCS->CurrentValue;
			$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
			$this->PCS->CellCssStyle .= "text-align: right;";
			$this->PCS->ViewCustomAttributes = "";
			$this->PCS->HrefValue = ""; // Clear href value
			$this->Box->CurrentValue = $this->Box->Total;
			$this->Box->ViewValue = $this->Box->CurrentValue;
			$this->Box->ViewValue = FormatNumber($this->Box->ViewValue, 0, -2, -2, -2);
			$this->Box->CellCssStyle .= "text-align: right;";
			$this->Box->ViewCustomAttributes = "";
			$this->Box->HrefValue = ""; // Clear href value

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->ID_His);
					$doc->exportCaption($this->PalletID);
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->ID_Location);
					$doc->exportCaption($this->PCS);
					$doc->exportCaption($this->DateIn);
					$doc->exportCaption($this->User_ID);
					$doc->exportCaption($this->PalletStatus);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->UpdateUser);
					$doc->exportCaption($this->UpdateDate);
					$doc->exportCaption($this->ID_Stock);
					$doc->exportCaption($this->Imp_Id);
					$doc->exportCaption($this->ID_Order);
					$doc->exportCaption($this->Box);
				} else {
					$doc->exportCaption($this->PalletID);
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->ID_Location);
					$doc->exportCaption($this->PCS);
					$doc->exportCaption($this->DateIn);
					$doc->exportCaption($this->User_ID);
					$doc->exportCaption($this->PalletStatus);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->Box);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);
				$this->aggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->ID_His);
						$doc->exportField($this->PalletID);
						$doc->exportField($this->Code);
						$doc->exportField($this->ID_Location);
						$doc->exportField($this->PCS);
						$doc->exportField($this->DateIn);
						$doc->exportField($this->User_ID);
						$doc->exportField($this->PalletStatus);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->UpdateUser);
						$doc->exportField($this->UpdateDate);
						$doc->exportField($this->ID_Stock);
						$doc->exportField($this->Imp_Id);
						$doc->exportField($this->ID_Order);
						$doc->exportField($this->Box);
					} else {
						$doc->exportField($this->PalletID);
						$doc->exportField($this->Code);
						$doc->exportField($this->ID_Location);
						$doc->exportField($this->PCS);
						$doc->exportField($this->DateIn);
						$doc->exportField($this->User_ID);
						$doc->exportField($this->PalletStatus);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->Box);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}

		// Export aggregates (horizontal format only)
		if ($doc->Horizontal) {
			$this->RowType = ROWTYPE_AGGREGATE;
			$this->resetAttributes();
			$this->aggregateListRow();
			if (!$doc->ExportCustom) {
				$doc->beginExportRow(-1);
				$doc->exportAggregate($this->PalletID, '');
				$doc->exportAggregate($this->Code, '');
				$doc->exportAggregate($this->ID_Location, '');
				$doc->exportAggregate($this->PCS, 'TOTAL');
				$doc->exportAggregate($this->DateIn, '');
				$doc->exportAggregate($this->User_ID, '');
				$doc->exportAggregate($this->PalletStatus, '');
				$doc->exportAggregate($this->CreateUser, '');
				$doc->exportAggregate($this->CreateDate, '');
				$doc->exportAggregate($this->Box, 'TOTAL');
				$doc->endExportRow();
			}
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
					$Security->loadCurrentUserLevel($PROJECT_ID . $this->TableName);
					if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
					$validRequest = $Security->canList(); // List permission
					if ($validRequest) {
						$Security->UserID_Loading();
						$Security->loadUserID();
						$Security->UserID_Loaded();
					}
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(CurrentProjectID() . $this->TableName);
			$Security->TablePermission_Loaded();
			$validRequest = $Security->canList(); // List permission
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'tbl_history_pick';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_history_pick';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_His'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'tbl_history_pick';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['ID_His'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) <> FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'tbl_history_pick';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_His'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>