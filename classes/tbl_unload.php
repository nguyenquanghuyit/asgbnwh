<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for tbl_unload
 */
class tbl_unload extends DbTable
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
	public $ID_Unload;
	public $ID_Route;
	public $Code;
	public $IdCode;
	public $PCS;
	public $RealPCS;
	public $Description;
	public $CreateUser;
	public $CreateDate;
	public $UserUnload;
	public $DateTime_Insert;
	public $UpdateUser;
	public $UpdateDate;
	public $MFG;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tbl_unload';
		$this->TableName = 'tbl_unload';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_unload`";
		$this->Dbid = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 8;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ID_Unload
		$this->ID_Unload = new DbField('tbl_unload', 'tbl_unload', 'x_ID_Unload', 'ID_Unload', '`ID_Unload`', '`ID_Unload`', 3, -1, FALSE, '`ID_Unload`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID_Unload->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID_Unload->IsPrimaryKey = TRUE; // Primary key field
		$this->ID_Unload->Sortable = FALSE; // Allow sort
		$this->ID_Unload->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Unload'] = &$this->ID_Unload;

		// ID_Route
		$this->ID_Route = new DbField('tbl_unload', 'tbl_unload', 'x_ID_Route', 'ID_Route', '`ID_Route`', '`ID_Route`', 3, -1, FALSE, '`ID_Route`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Route->IsForeignKey = TRUE; // Foreign key field
		$this->ID_Route->Sortable = FALSE; // Allow sort
		$this->ID_Route->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Route'] = &$this->ID_Route;

		// Code
		$this->Code = new DbField('tbl_unload', 'tbl_unload', 'x_Code', 'Code', '`Code`', '`Code`', 200, -1, FALSE, '`EV__Code`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->Code->Nullable = FALSE; // NOT NULL field
		$this->Code->Required = TRUE; // Required field
		$this->Code->Sortable = TRUE; // Allow sort
		$this->Code->Lookup = new Lookup('Code', 'tbl_product', FALSE, 'Code', ["Code","ProductName","",""], [], [], [], [], [], [], '', '');
		$this->fields['Code'] = &$this->Code;

		// IdCode
		$this->IdCode = new DbField('tbl_unload', 'tbl_unload', 'x_IdCode', 'IdCode', '`IdCode`', '`IdCode`', 3, -1, FALSE, '`IdCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IdCode->Sortable = TRUE; // Allow sort
		$this->IdCode->Lookup = new Lookup('IdCode', 'tbl_product_detail', FALSE, 'IdCode', ["PackingQty","","",""], [], [], [], [], [], [], '', '');
		$this->IdCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['IdCode'] = &$this->IdCode;

		// PCS
		$this->PCS = new DbField('tbl_unload', 'tbl_unload', 'x_PCS', 'PCS', '`PCS`', '`PCS`', 3, -1, FALSE, '`PCS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PCS->Nullable = FALSE; // NOT NULL field
		$this->PCS->Required = TRUE; // Required field
		$this->PCS->Sortable = TRUE; // Allow sort
		$this->PCS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PCS'] = &$this->PCS;

		// RealPCS
		$this->RealPCS = new DbField('tbl_unload', 'tbl_unload', 'x_RealPCS', 'RealPCS', '`RealPCS`', '`RealPCS`', 3, -1, FALSE, '`RealPCS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RealPCS->Nullable = FALSE; // NOT NULL field
		$this->RealPCS->Required = TRUE; // Required field
		$this->RealPCS->Sortable = TRUE; // Allow sort
		$this->RealPCS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['RealPCS'] = &$this->RealPCS;

		// Description
		$this->Description = new DbField('tbl_unload', 'tbl_unload', 'x_Description', 'Description', '`Description`', '`Description`', 200, -1, FALSE, '`Description`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Description->Sortable = TRUE; // Allow sort
		$this->fields['Description'] = &$this->Description;

		// CreateUser
		$this->CreateUser = new DbField('tbl_unload', 'tbl_unload', 'x_CreateUser', 'CreateUser', '`CreateUser`', '`CreateUser`', 200, -1, FALSE, '`CreateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateUser->Sortable = TRUE; // Allow sort
		$this->fields['CreateUser'] = &$this->CreateUser;

		// CreateDate
		$this->CreateDate = new DbField('tbl_unload', 'tbl_unload', 'x_CreateDate', 'CreateDate', '`CreateDate`', CastDateFieldForLike('`CreateDate`', 0, "DB"), 135, 0, FALSE, '`CreateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateDate->Sortable = TRUE; // Allow sort
		$this->CreateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['CreateDate'] = &$this->CreateDate;

		// UserUnload
		$this->UserUnload = new DbField('tbl_unload', 'tbl_unload', 'x_UserUnload', 'UserUnload', '`UserUnload`', '`UserUnload`', 200, -1, FALSE, '`EV__UserUnload`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->UserUnload->Nullable = FALSE; // NOT NULL field
		$this->UserUnload->Required = TRUE; // Required field
		$this->UserUnload->Sortable = FALSE; // Allow sort
		$this->UserUnload->Lookup = new Lookup('UserUnload', 'nhanvien', FALSE, 'Ma_NV', ["Ma_NV","hoVaTen","",""], [], [], [], [], [], [], '', '');
		$this->fields['UserUnload'] = &$this->UserUnload;

		// DateTime_Insert
		$this->DateTime_Insert = new DbField('tbl_unload', 'tbl_unload', 'x_DateTime_Insert', 'DateTime_Insert', '`DateTime_Insert`', CastDateFieldForLike('`DateTime_Insert`', 11, "DB"), 135, 11, FALSE, '`DateTime_Insert`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateTime_Insert->Nullable = FALSE; // NOT NULL field
		$this->DateTime_Insert->Required = TRUE; // Required field
		$this->DateTime_Insert->Sortable = FALSE; // Allow sort
		$this->DateTime_Insert->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['DateTime_Insert'] = &$this->DateTime_Insert;

		// UpdateUser
		$this->UpdateUser = new DbField('tbl_unload', 'tbl_unload', 'x_UpdateUser', 'UpdateUser', '`UpdateUser`', '`UpdateUser`', 200, -1, FALSE, '`UpdateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateUser->Sortable = FALSE; // Allow sort
		$this->fields['UpdateUser'] = &$this->UpdateUser;

		// UpdateDate
		$this->UpdateDate = new DbField('tbl_unload', 'tbl_unload', 'x_UpdateDate', 'UpdateDate', '`UpdateDate`', CastDateFieldForLike('`UpdateDate`', 0, "DB"), 135, 0, FALSE, '`UpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateDate->Sortable = FALSE; // Allow sort
		$this->UpdateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['UpdateDate'] = &$this->UpdateDate;

		// MFG
		$this->MFG = new DbField('tbl_unload', 'tbl_unload', 'x_MFG', 'MFG', '`MFG`', CastDateFieldForLike('`MFG`', 7, "DB"), 133, 7, FALSE, '`MFG`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MFG->Sortable = TRUE; // Allow sort
		$this->MFG->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['MFG'] = &$this->MFG;
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
			$sortFieldList = ($fld->VirtualExpression <> "") ? $fld->VirtualExpression : $sortField;
			if ($ctrl) {
				$orderByList = $this->getSessionOrderByList();
				if (ContainsString($orderByList, $sortFieldList . " " . $lastSort)) {
					$orderByList = str_replace($sortFieldList . " " . $lastSort, $sortFieldList . " " . $thisSort, $orderByList);
				} else {
					if ($orderByList <> "") $orderByList .= ", ";
					$orderByList .= $sortFieldList . " " . $thisSort;
				}
				$this->setSessionOrderByList($orderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST] = $v;
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
		if ($this->getCurrentMasterTable() == "tbl_route") {
			if ($this->ID_Route->getSessionValue() <> "")
				$masterFilter .= "`ID_Route`=" . QuotedValue($this->ID_Route->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "tbl_route") {
			if ($this->ID_Route->getSessionValue() <> "")
				$detailFilter .= "`ID_Route`=" . QuotedValue($this->ID_Route->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_tbl_route()
	{
		return "`ID_Route`=@ID_Route@";
	}

	// Detail filter
	public function sqlDetailFilter_tbl_route()
	{
		return "`ID_Route`=@ID_Route@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`tbl_unload`";
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
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT CONCAT(COALESCE(`Code`, ''),'" . ValueSeparator(1, $this->Code) . "',COALESCE(`ProductName`,'')) FROM `tbl_product` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`Code` = `tbl_unload`.`Code` LIMIT 1) AS `EV__Code`, (SELECT CONCAT(COALESCE(`Ma_NV`, ''),'" . ValueSeparator(1, $this->UserUnload) . "',COALESCE(`hoVaTen`,'')) FROM `nhanvien` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`Ma_NV` = `tbl_unload`.`UserUnload` LIMIT 1) AS `EV__UserUnload` FROM `tbl_unload`" .
			") `TMP_TABLE`";
		return ($this->SqlSelectList <> "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
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
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where <> "")
			$where = " " . str_replace(array("(",")"), array("",""), $where) . " ";
		if ($orderBy <> "")
			$orderBy = " " . str_replace(array("(",")"), array("",""), $orderBy) . " ";
		if ($this->BasicSearch->getKeyword() <> "")
			return TRUE;
		if ($this->Code->AdvancedSearch->SearchValue <> "" ||
			$this->Code->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->Code->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->Code->VirtualExpression . " "))
			return TRUE;
		if ($this->UserUnload->AdvancedSearch->SearchValue <> "" ||
			$this->UserUnload->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->UserUnload->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->UserUnload->VirtualExpression . " "))
			return TRUE;
		return FALSE;
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
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
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
			$this->ID_Unload->setDbValue($conn->insert_ID());
			$rs['ID_Unload'] = $this->ID_Unload->DbValue;
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
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'ID_Unload';
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
			if (array_key_exists('ID_Unload', $rs))
				AddFilter($where, QuotedName('ID_Unload', $this->Dbid) . '=' . QuotedValue($rs['ID_Unload'], $this->ID_Unload->DataType, $this->Dbid));
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
		$this->ID_Unload->DbValue = $row['ID_Unload'];
		$this->ID_Route->DbValue = $row['ID_Route'];
		$this->Code->DbValue = $row['Code'];
		$this->IdCode->DbValue = $row['IdCode'];
		$this->PCS->DbValue = $row['PCS'];
		$this->RealPCS->DbValue = $row['RealPCS'];
		$this->Description->DbValue = $row['Description'];
		$this->CreateUser->DbValue = $row['CreateUser'];
		$this->CreateDate->DbValue = $row['CreateDate'];
		$this->UserUnload->DbValue = $row['UserUnload'];
		$this->DateTime_Insert->DbValue = $row['DateTime_Insert'];
		$this->UpdateUser->DbValue = $row['UpdateUser'];
		$this->UpdateDate->DbValue = $row['UpdateDate'];
		$this->MFG->DbValue = $row['MFG'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID_Unload` = @ID_Unload@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('ID_Unload', $row) ? $row['ID_Unload'] : NULL) : $this->ID_Unload->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID_Unload@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "tbl_unloadlist.php";
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
		if ($pageName == "tbl_unloadview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_unloadedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_unloadadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_unloadlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("tbl_unloadview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_unloadview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "tbl_unloadadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_unloadadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_unloadedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("tbl_unloadadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("tbl_unloaddelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "tbl_route" && !ContainsString($url, TABLE_SHOW_MASTER . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ID_Route=" . urlencode($this->ID_Route->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID_Unload:" . JsonEncode($this->ID_Unload->CurrentValue, "number");
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
		if ($this->ID_Unload->CurrentValue != NULL) {
			$url .= "ID_Unload=" . urlencode($this->ID_Unload->CurrentValue);
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
			if (Param("ID_Unload") !== NULL)
				$arKeys[] = Param("ID_Unload");
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
			$this->ID_Unload->CurrentValue = $key;
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
		$this->ID_Unload->setDbValue($rs->fields('ID_Unload'));
		$this->ID_Route->setDbValue($rs->fields('ID_Route'));
		$this->Code->setDbValue($rs->fields('Code'));
		$this->IdCode->setDbValue($rs->fields('IdCode'));
		$this->PCS->setDbValue($rs->fields('PCS'));
		$this->RealPCS->setDbValue($rs->fields('RealPCS'));
		$this->Description->setDbValue($rs->fields('Description'));
		$this->CreateUser->setDbValue($rs->fields('CreateUser'));
		$this->CreateDate->setDbValue($rs->fields('CreateDate'));
		$this->UserUnload->setDbValue($rs->fields('UserUnload'));
		$this->DateTime_Insert->setDbValue($rs->fields('DateTime_Insert'));
		$this->UpdateUser->setDbValue($rs->fields('UpdateUser'));
		$this->UpdateDate->setDbValue($rs->fields('UpdateDate'));
		$this->MFG->setDbValue($rs->fields('MFG'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID_Unload

		$this->ID_Unload->CellCssStyle = "white-space: nowrap;";

		// ID_Route
		$this->ID_Route->CellCssStyle = "white-space: nowrap;";

		// Code
		$this->Code->CellCssStyle = "white-space: nowrap;";

		// IdCode
		$this->IdCode->CellCssStyle = "white-space: nowrap;";

		// PCS
		$this->PCS->CellCssStyle = "white-space: nowrap;";

		// RealPCS
		$this->RealPCS->CellCssStyle = "white-space: nowrap;";

		// Description
		$this->Description->CellCssStyle = "white-space: nowrap;";

		// CreateUser
		$this->CreateUser->CellCssStyle = "white-space: nowrap;";

		// CreateDate
		$this->CreateDate->CellCssStyle = "white-space: nowrap;";

		// UserUnload
		$this->UserUnload->CellCssStyle = "white-space: nowrap;";

		// DateTime_Insert
		$this->DateTime_Insert->CellCssStyle = "white-space: nowrap;";

		// UpdateUser
		$this->UpdateUser->CellCssStyle = "white-space: nowrap;";

		// UpdateDate
		$this->UpdateDate->CellCssStyle = "white-space: nowrap;";

		// MFG
		$this->MFG->CellCssStyle = "white-space: nowrap;";

		// ID_Unload
		$this->ID_Unload->ViewValue = $this->ID_Unload->CurrentValue;
		$this->ID_Unload->ViewCustomAttributes = "";

		// ID_Route
		$this->ID_Route->ViewValue = $this->ID_Route->CurrentValue;
		$this->ID_Route->ViewValue = FormatNumber($this->ID_Route->ViewValue, 0, -2, -2, -2);
		$this->ID_Route->ViewCustomAttributes = "";

		// Code
		if ($this->Code->VirtualValue <> "") {
			$this->Code->ViewValue = $this->Code->VirtualValue;
		} else {
			$this->Code->ViewValue = $this->Code->CurrentValue;
		$curVal = strval($this->Code->CurrentValue);
		if ($curVal <> "") {
			$this->Code->ViewValue = $this->Code->lookupCacheOption($curVal);
			if ($this->Code->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Code`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->Code->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->Code->ViewValue = $this->Code->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->Code->ViewValue = $this->Code->CurrentValue;
				}
			}
		} else {
			$this->Code->ViewValue = NULL;
		}
		}
		$this->Code->ViewCustomAttributes = "";

		// IdCode
		$this->IdCode->ViewValue = $this->IdCode->CurrentValue;
		$curVal = strval($this->IdCode->CurrentValue);
		if ($curVal <> "") {
			$this->IdCode->ViewValue = $this->IdCode->lookupCacheOption($curVal);
			if ($this->IdCode->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`IdCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->IdCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
					$this->IdCode->ViewValue = $this->IdCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->IdCode->ViewValue = $this->IdCode->CurrentValue;
				}
			}
		} else {
			$this->IdCode->ViewValue = NULL;
		}
		$this->IdCode->CellCssStyle .= "text-align: center;";
		$this->IdCode->ViewCustomAttributes = "";

		// PCS
		$this->PCS->ViewValue = $this->PCS->CurrentValue;
		$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
		$this->PCS->CellCssStyle .= "text-align: right;";
		$this->PCS->ViewCustomAttributes = "";

		// RealPCS
		$this->RealPCS->ViewValue = $this->RealPCS->CurrentValue;
		$this->RealPCS->ViewValue = FormatNumber($this->RealPCS->ViewValue, 0, -2, -2, -2);
		$this->RealPCS->CellCssStyle .= "text-align: right;";
		$this->RealPCS->ViewCustomAttributes = "";

		// Description
		$this->Description->ViewValue = $this->Description->CurrentValue;
		$this->Description->ViewCustomAttributes = "";

		// CreateUser
		$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->ViewCustomAttributes = "";

		// CreateDate
		$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
		$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 0);
		$this->CreateDate->ViewCustomAttributes = "";

		// UserUnload
		if ($this->UserUnload->VirtualValue <> "") {
			$this->UserUnload->ViewValue = $this->UserUnload->VirtualValue;
		} else {
			$this->UserUnload->ViewValue = $this->UserUnload->CurrentValue;
		$curVal = strval($this->UserUnload->CurrentValue);
		if ($curVal <> "") {
			$this->UserUnload->ViewValue = $this->UserUnload->lookupCacheOption($curVal);
			if ($this->UserUnload->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`Ma_NV`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->UserUnload->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->UserUnload->ViewValue = $this->UserUnload->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->UserUnload->ViewValue = $this->UserUnload->CurrentValue;
				}
			}
		} else {
			$this->UserUnload->ViewValue = NULL;
		}
		}
		$this->UserUnload->ViewCustomAttributes = "";

		// DateTime_Insert
		$this->DateTime_Insert->ViewValue = $this->DateTime_Insert->CurrentValue;
		$this->DateTime_Insert->ViewValue = FormatDateTime($this->DateTime_Insert->ViewValue, 11);
		$this->DateTime_Insert->ViewCustomAttributes = "";

		// UpdateUser
		$this->UpdateUser->ViewValue = $this->UpdateUser->CurrentValue;
		$this->UpdateUser->ViewCustomAttributes = "";

		// UpdateDate
		$this->UpdateDate->ViewValue = $this->UpdateDate->CurrentValue;
		$this->UpdateDate->ViewValue = FormatDateTime($this->UpdateDate->ViewValue, 0);
		$this->UpdateDate->ViewCustomAttributes = "";

		// MFG
		$this->MFG->ViewValue = $this->MFG->CurrentValue;
		$this->MFG->ViewValue = FormatDateTime($this->MFG->ViewValue, 7);
		$this->MFG->CellCssStyle .= "text-align: center;";
		$this->MFG->ViewCustomAttributes = "";

		// ID_Unload
		$this->ID_Unload->LinkCustomAttributes = "";
		$this->ID_Unload->HrefValue = "";
		$this->ID_Unload->TooltipValue = "";

		// ID_Route
		$this->ID_Route->LinkCustomAttributes = "";
		$this->ID_Route->HrefValue = "";
		$this->ID_Route->TooltipValue = "";

		// Code
		$this->Code->LinkCustomAttributes = "";
		$this->Code->HrefValue = "";
		$this->Code->TooltipValue = "";

		// IdCode
		$this->IdCode->LinkCustomAttributes = "";
		$this->IdCode->HrefValue = "";
		$this->IdCode->TooltipValue = "";

		// PCS
		$this->PCS->LinkCustomAttributes = "";
		$this->PCS->HrefValue = "";
		$this->PCS->TooltipValue = "";

		// RealPCS
		$this->RealPCS->LinkCustomAttributes = "";
		$this->RealPCS->HrefValue = "";
		$this->RealPCS->TooltipValue = "";

		// Description
		$this->Description->LinkCustomAttributes = "";
		$this->Description->HrefValue = "";
		$this->Description->TooltipValue = "";

		// CreateUser
		$this->CreateUser->LinkCustomAttributes = "";
		$this->CreateUser->HrefValue = "";
		$this->CreateUser->TooltipValue = "";

		// CreateDate
		$this->CreateDate->LinkCustomAttributes = "";
		$this->CreateDate->HrefValue = "";
		$this->CreateDate->TooltipValue = "";

		// UserUnload
		$this->UserUnload->LinkCustomAttributes = "";
		$this->UserUnload->HrefValue = "";
		$this->UserUnload->TooltipValue = "";

		// DateTime_Insert
		$this->DateTime_Insert->LinkCustomAttributes = "";
		$this->DateTime_Insert->HrefValue = "";
		$this->DateTime_Insert->TooltipValue = "";

		// UpdateUser
		$this->UpdateUser->LinkCustomAttributes = "";
		$this->UpdateUser->HrefValue = "";
		$this->UpdateUser->TooltipValue = "";

		// UpdateDate
		$this->UpdateDate->LinkCustomAttributes = "";
		$this->UpdateDate->HrefValue = "";
		$this->UpdateDate->TooltipValue = "";

		// MFG
		$this->MFG->LinkCustomAttributes = "";
		$this->MFG->HrefValue = "";
		$this->MFG->TooltipValue = "";

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

		// ID_Unload
		$this->ID_Unload->EditAttrs["class"] = "form-control";
		$this->ID_Unload->EditCustomAttributes = "";
		$this->ID_Unload->EditValue = $this->ID_Unload->CurrentValue;
		$this->ID_Unload->ViewCustomAttributes = "";

		// ID_Route
		$this->ID_Route->EditAttrs["class"] = "form-control";
		$this->ID_Route->EditCustomAttributes = "";
		if ($this->ID_Route->getSessionValue() <> "") {
			$this->ID_Route->CurrentValue = $this->ID_Route->getSessionValue();
		$this->ID_Route->ViewValue = $this->ID_Route->CurrentValue;
		$this->ID_Route->ViewValue = FormatNumber($this->ID_Route->ViewValue, 0, -2, -2, -2);
		$this->ID_Route->ViewCustomAttributes = "";
		} else {
		$this->ID_Route->EditValue = $this->ID_Route->CurrentValue;
		$this->ID_Route->PlaceHolder = RemoveHtml($this->ID_Route->caption());
		}

		// Code
		$this->Code->EditAttrs["class"] = "form-control";
		$this->Code->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
		$this->Code->EditValue = $this->Code->CurrentValue;
		$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

		// IdCode
		$this->IdCode->EditAttrs["class"] = "form-control";
		$this->IdCode->EditCustomAttributes = "";
		$this->IdCode->EditValue = $this->IdCode->CurrentValue;
		$curVal = strval($this->IdCode->CurrentValue);
		if ($curVal <> "") {
			$this->IdCode->EditValue = $this->IdCode->lookupCacheOption($curVal);
			if ($this->IdCode->EditValue === NULL) { // Lookup from database
				$filterWrk = "`IdCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->IdCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
					$this->IdCode->EditValue = $this->IdCode->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->IdCode->EditValue = $this->IdCode->CurrentValue;
				}
			}
		} else {
			$this->IdCode->EditValue = NULL;
		}
		$this->IdCode->CellCssStyle .= "text-align: center;";
		$this->IdCode->ViewCustomAttributes = "";

		// PCS
		$this->PCS->EditAttrs["class"] = "form-control";
		$this->PCS->EditCustomAttributes = "";
		$this->PCS->EditValue = $this->PCS->CurrentValue;
		$this->PCS->PlaceHolder = RemoveHtml($this->PCS->caption());

		// RealPCS
		$this->RealPCS->EditAttrs["class"] = "form-control";
		$this->RealPCS->EditCustomAttributes = "";
		$this->RealPCS->EditValue = $this->RealPCS->CurrentValue;
		$this->RealPCS->PlaceHolder = RemoveHtml($this->RealPCS->caption());

		// Description
		$this->Description->EditAttrs["class"] = "form-control";
		$this->Description->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Description->CurrentValue = HtmlDecode($this->Description->CurrentValue);
		$this->Description->EditValue = $this->Description->CurrentValue;
		$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

		// CreateUser
		// CreateDate
		// UserUnload

		$this->UserUnload->EditAttrs["class"] = "form-control";
		$this->UserUnload->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->UserUnload->CurrentValue = HtmlDecode($this->UserUnload->CurrentValue);
		$this->UserUnload->EditValue = $this->UserUnload->CurrentValue;
		$this->UserUnload->PlaceHolder = RemoveHtml($this->UserUnload->caption());

		// DateTime_Insert
		$this->DateTime_Insert->EditAttrs["class"] = "form-control";
		$this->DateTime_Insert->EditCustomAttributes = "";
		$this->DateTime_Insert->EditValue = FormatDateTime($this->DateTime_Insert->CurrentValue, 11);
		$this->DateTime_Insert->PlaceHolder = RemoveHtml($this->DateTime_Insert->caption());

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

		// MFG
		$this->MFG->EditAttrs["class"] = "form-control";
		$this->MFG->EditCustomAttributes = "";
		$this->MFG->EditValue = FormatDateTime($this->MFG->CurrentValue, 7);
		$this->MFG->PlaceHolder = RemoveHtml($this->MFG->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->PCS->CurrentValue))
				$this->PCS->Total += $this->PCS->CurrentValue; // Accumulate total
			if (is_numeric($this->RealPCS->CurrentValue))
				$this->RealPCS->Total += $this->RealPCS->CurrentValue; // Accumulate total
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
			$this->RealPCS->CurrentValue = $this->RealPCS->Total;
			$this->RealPCS->ViewValue = $this->RealPCS->CurrentValue;
			$this->RealPCS->ViewValue = FormatNumber($this->RealPCS->ViewValue, 0, -2, -2, -2);
			$this->RealPCS->CellCssStyle .= "text-align: right;";
			$this->RealPCS->ViewCustomAttributes = "";
			$this->RealPCS->HrefValue = ""; // Clear href value

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
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->IdCode);
					$doc->exportCaption($this->PCS);
					$doc->exportCaption($this->RealPCS);
					$doc->exportCaption($this->Description);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->MFG);
				} else {
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->IdCode);
					$doc->exportCaption($this->PCS);
					$doc->exportCaption($this->RealPCS);
					$doc->exportCaption($this->Description);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->MFG);
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
						$doc->exportField($this->Code);
						$doc->exportField($this->IdCode);
						$doc->exportField($this->PCS);
						$doc->exportField($this->RealPCS);
						$doc->exportField($this->Description);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->MFG);
					} else {
						$doc->exportField($this->Code);
						$doc->exportField($this->IdCode);
						$doc->exportField($this->PCS);
						$doc->exportField($this->RealPCS);
						$doc->exportField($this->Description);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->MFG);
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
				$doc->exportAggregate($this->Code, '');
				$doc->exportAggregate($this->IdCode, '');
				$doc->exportAggregate($this->PCS, 'TOTAL');
				$doc->exportAggregate($this->RealPCS, 'TOTAL');
				$doc->exportAggregate($this->Description, '');
				$doc->exportAggregate($this->CreateUser, '');
				$doc->exportAggregate($this->CreateDate, '');
				$doc->exportAggregate($this->MFG, '');
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
		$table = 'tbl_unload';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_unload';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_Unload'];

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
		$table = 'tbl_unload';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['ID_Unload'];

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
		$table = 'tbl_unload';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_Unload'];

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