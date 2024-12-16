<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SQL Explorer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="theme.js" defer></script>
</head>
<style>
/* Modern SQL Client Interface Styles */
/* Modern SQL Client Interface Styles */
/* Modern SQL Client Interface Styles */
/* Modern SQL Client Interface Styles */
:root {
    /* Light theme */
    --light-primary: #0ea5e9;
    --light-secondary: #0284c7;
    --light-background: #f8fafc;
    --light-sidebar: #ffffff;
    --light-text: #0f172a;
    --light-border: #e2e8f0;
    --light-hover: #f1f5f9;
    
    /* Dark theme (current theme) */
    --dark-primary: #f97316;
    --dark-secondary: #ea580c;
    --dark-background: #0f172a;
    --dark-sidebar: #1e293b;
    --dark-text: #e2e8f0;
    --dark-border: #334155;
    --dark-hover: rgba(255, 255, 255, 0.05);
    
    --primary-color: var(--dark-primary);
    --secondary-color: var(--dark-secondary);
    --background-color: var(--dark-background);
    --sidebar-bg: var(--dark-sidebar);
    --text-color: var(--dark-text);
    --border-color: var(--dark-border);
    --hover-color: var(--dark-hover);
}

:root[data-theme="dark"] {
    --primary-color: var(--dark-primary);
    --secondary-color: var(--dark-secondary);
    --background-color: var(--dark-background);
    --sidebar-bg: var(--dark-sidebar);
    --text-color: var(--dark-text);
    --border-color: var(--dark-border);
    --hover-color: var(--dark-hover);
}

:root[data-theme="light"] {
    --primary-color: var(--light-primary);
    --secondary-color: var(--light-secondary);
    --background-color: var(--light-background);
    --sidebar-bg: var(--light-sidebar);
    --text-color: var(--light-text);
    --border-color: var(--light-border);
    --hover-color: var(--light-hover);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
}

body {
    background-color: var(--background-color);
    color: var(--text-color);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Top Navigation */
.top-nav {
    background: var(--sidebar-bg);
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--border-color);
}

.nav-controls {
    display: flex;
    gap: 1rem;
}

.primary-btn, .secondary-btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
}

.primary-btn {
    background: var(--primary-color);
    color: white;
}

.secondary-btn {
    background: transparent;
    border: 1px solid var(--border-color);
    color: var(--text-color);
}

.primary-btn:hover {
    background: var(--secondary-color);
}

.secondary-btn:hover {
    background: var(--hover-color);
}

/* Theme Toggle Button */
.theme-toggle {
    padding: 0.5rem;
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    background: transparent;
    color: var(--text-color);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.theme-toggle:hover {
    background: var(--hover-color);
}

.theme-icon {
    font-size: 1.2rem;
}

[data-theme="light"] .theme-icon {
    content: "🌙";
}

[data-theme="dark"] .theme-icon {
    content: "☀️";
}

/* Workspace Layout */
.workspace {
    flex: 1;
    display: flex;
    overflow: hidden;
}

/* Database Explorer */
.db-explorer {
    width: 280px;
    background: var(--sidebar-bg);
    border-right: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
    overflow-y: auto;
}

.explorer-section {
    padding: 1.5rem;
}

.explorer-section h2 {
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 1rem;
    color: var(--text-color);
    opacity: 0.7;
}

.db-list, .table-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.db-card {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.2s;
}

.db-card:hover {
    background: rgba(255, 255, 255, 0.1);
}

.db-icon {
    font-size: 1.2rem;
}

/* Query Workspace */
.query-workspace {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 1.5rem;
    gap: 1.5rem;
    overflow-y: auto;
}

.query-editor {
    background: var(--sidebar-bg);
    border-radius: 0.75rem;
    padding: 1rem;
    border: 1px solid var(--border-color);
}

.editor-area {
    width: 100%;
    min-height: 150px;
    background: transparent;
    border: none;
    color: var(--text-color);
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.95rem;
    line-height: 1.5;
    resize: vertical;
    padding: 0.5rem;
    outline: none;
}

.results-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    flex: 1;
    min-height: 500px;
}

.result-panel {
    background: var(--sidebar-bg);
    border-radius: 0.75rem;
    border: 1px solid var(--border-color);
    overflow: hidden;
    flex: 1;
}

.panel-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    background: rgba(255, 255, 255, 0.02);
}

.panel-header h2 {
    font-size: 1.1rem;
    font-weight: 500;
}

.panel-content {
    padding: 1.5rem;
    overflow: auto;
    height: calc(100% - 60px);
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
}

th, td {
    padding: 1rem 1.5rem;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
    white-space: nowrap;
}

th {
    background: rgba(255, 255, 255, 0.05);
    font-weight: 500;
    position: sticky;
    top: 0;
    z-index: 10;
}

td {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.9rem;
}

tr:hover td {
    background: rgba(255, 255, 255, 0.02);
}

/* Responsive Design */
@media (max-width: 768px) {
    .workspace {
        flex-direction: column;
    }
    
    .db-explorer {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid var(--border-color);
        max-height: 300px;
    }
}

/* Scrollbar Styles */
::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

::-webkit-scrollbar-track {
    background: var(--background-color);
}

::-webkit-scrollbar-thumb {
    background: var(--border-color);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background: #475569;
}

    </style>
<body>
<nav class="top-nav">
        <h1>SQL Explorer</h1>
        <div class="nav-controls">
            <button onclick="toggleTheme()" class="theme-toggle" title="Toggle theme">
                <span class="theme-icon">🌙</span>
            </button>
            <button onclick="runQuery()" class="primary-btn">Execute Query</button>
            <button onclick="clearResults()" class="secondary-btn">Clear</button>
        </div>
    </nav>

    <div class="workspace">
        <aside class="db-explorer">
            <div class="explorer-section">
                <h2>Database Explorer</h2>
                <div class="db-list">
                    @foreach($databases as $dbId => $dbName)
                        <div class="db-card" onclick="loadTables({{ $dbId }}, '{{ $dbName }}', event)">
                            <span class="db-icon">📁</span>
                            <span class="db-name">{{ $dbName }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="explorer-section">
                <h2>Tables</h2>
                <div id="table-selection" class="table-list"></div>
            </div>
        </aside>

        <main class="query-workspace">
            <div class="query-editor">
                <textarea id="sql-query" 
                          class="editor-area" 
                          placeholder="SELECT * FROM your_table..."></textarea>
            </div>

            <div class="results-container">
                <div class="result-panel">
                    <div class="panel-header">
                        <h2>Query Results</h2>
                    </div>
                    <div id="result-output" class="panel-content"></div>
                </div>

                <div class="result-panel">
                    <div class="panel-header">
                        <h2>Generated SQL</h2>
                    </div>
                    <div id="internal-query-output" class="panel-content"></div>
                </div>
            </div>
        </main>
    </div>
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        // Theme switching functionality
function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    html.setAttribute('data-theme', newTheme);
    
    // Update theme icon
    const themeIcon = document.querySelector('.theme-icon');
    themeIcon.textContent = newTheme === 'dark' ? '🌙' : '☀️';
    
    // Save theme preference
    localStorage.setItem('theme', newTheme);
}

// Set initial theme from localStorage
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'dark';
    document.documentElement.setAttribute('data-theme', savedTheme);
    
    const themeIcon = document.querySelector('.theme-icon');
    themeIcon.textContent = savedTheme === 'dark' ? '🌙' : '☀️';
});

        // Optional function to load table content (this could be implemented as needed)
        // Function to load tables for a given database
        function runQuery() {
    // Retrieve the SQL query from the textarea
    const sqlQuery = $('#sql-query').val();

    // Verify the input isn't empty
    if (sqlQuery.trim() === '') {
        alert('Please enter a valid SQL query.');
        return;
    }

    // Send the SQL query to the backend via AJAX
    $.ajax({
        url: '/run-query', // Laravel route URL
        type: 'POST',
        data: {
            sql_query: sqlQuery,
            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
        },
        success: function(response) {
            // Clear previous internal query bubbles
            $('#internal-query-output').empty();

            if (response.success) {
                if (response.selected_db) {
                    // Update UI to display selected database
                    $('#selected-db').html(`Selected Database: <strong>${response.selected_db}</strong>`);

                    // Highlight the selected database in the sidebar
                    highlightSelectedDb(response.selected_db);

                    // Optional: highlight the query or set focus to the query input after the USE command
                    //$('#sql-query').val(`USE ${response.selected_db};`);
                }
                if (response.tablename) {
                    // Update UI to display selected database
                    $('#selected-table').html(` <strong>${response.tablename}</strong>`);

                    // Highlight the selected database in the sidebar
                    highlightSelectedtable(response.tablename);

                    // Optional: highlight the query or set focus to the query input after the USE command
                    // $('#sql-query').val(`USE ${response.tablename};`);
                }
                if (response.db_id) {
                    // Update UI to display selected database
                    loadTables2(response.db_id, response.dbname);
                }
                // Display internal queries as bubble elements
                const bubbleContainer = $('#internal-query-output');
                
                if (response.internal_query) {
                    // Check if internal_query is an array or a string and display accordingly
                    if (Array.isArray(response.internal_query)) {
                        response.internal_query.forEach(function(query) {
                            const bubble = $('<div class="query-bubble-array"></div>').text(query);
                            bubbleContainer.append(bubble);
                        });
                    } else {
                        // If it's a string, just display it as one bubble
                        const bubble = $('<div class="query-bubble-string"></div>').text(response.internal_query);
            bubbleContainer.append(bubble);
                    }
                }

                // Existing logic for handling table results or databases
                if (response.columns && response.data) {
                    let resultHtml = '<table border="1" cellpadding="10" cellspacing="0"><thead><tr>';
                    
                    // Create table headers from columns
                    response.columns.forEach(function(column) {
                        resultHtml += `<th>${column}</th>`;
                    });
                    resultHtml += '</tr></thead><tbody>';

                    // Create table rows from the data
                    let rowCount = response.data[response.columns[0]].length; // Get the number of rows
                    for (let i = 0; i < rowCount; i++) {
                        resultHtml += '<tr>';
                        response.columns.forEach(function(column) {
                            resultHtml += `<td>${response.data[column][i]}</td>`;
                        });
                        resultHtml += '</tr>';
                    }

                    resultHtml += '</tbody></table>';
                    $('#result-output').html(resultHtml);
                } else {
                    // If the result is not a table, just show the result as JSON
                    $('#result-output').html('<pre class="json-result">' + JSON.stringify(response.result, null, 2) + '</pre>');
                }
            } else {
                // Handle failure response
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Failed to execute query: ' + error);
        }
    });
}


function highlightSelectedDb(dbName) {
    // Remove 'selected-db' class from all database items
    document.querySelectorAll('.database-item').forEach(item => {
        item.classList.remove('selected-db');
    });

    // Loop through all database items to find a match
    document.querySelectorAll('.database-item').forEach(item => {
        if (item.textContent.trim() === dbName.trim()) {
            item.classList.add('selected-db');
        }
    });
}
function highlightSelectedtable(tablename) {
    // Remove 'selected-db' class from all database items
    document.querySelectorAll('.table-item').forEach(item => {
        item.classList.remove('selected-table');
    });

    // Loop through all database items to find a match
    document.querySelectorAll('.table-item').forEach(item => {
        if (item.textContent.trim() === tablename.trim()) {
            item.classList.add('selected-table');
        }
    });
}

function loadTables2(dbId, dbName) {
    $.get('/tables/' + dbId)
        .done(function(data) {
            const tableSelection = document.getElementById('table-selection');
            tableSelection.innerHTML = '';

            if (data.tables && data.tables.length > 0) {
                data.tables.forEach(function(table) {
                    const tableDiv = document.createElement('div');
                    tableDiv.classList.add('table-item');
                    tableDiv.innerText = table;

                    // Add click event listener to highlight the selected table
                    tableDiv.onclick = function () {
                        // Highlight the selected table
                        document.querySelectorAll('.table-item').forEach(item => {
                            item.classList.remove('selected-table');
                        });
                        this.classList.add('selected-table');

                        // Fetch and display the table data
                        $.ajax({
                            url: '/select', // Your route for selecting the table
                            type: 'POST',
                            data: {
                                query: `SELECT * FROM ${table}`,
                                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                            },
                            success: function(response) {
                                displayTableData(response); // Function to handle the response and display data
                            },
                            error: function(xhr, status, error) {
                                console.error('Failed to fetch table data', status, error, xhr.responseText);
                                alert('Failed to fetch table data.');
                            }
                        });
                    };

                    tableSelection.appendChild(tableDiv);
                });
            } else {
                tableSelection.innerHTML = 'No tables found for this database.';
            }
        })
        .fail(function(xhr, status, error) {
            console.error('AJAX Request Failed', status, error, xhr.responseText);
            alert('Failed to load tables. Check the console for more details.');
        });
}



function loadTables(dbId, dbName) {
    // clearResults();
    // Step 1: Send the 'USE ${dbname}' query via AJAX to the controller
    $.ajax({
        url: '/run-query', // The route to the controller method that handles the query
        type: 'POST',
        data: {
            sql_query: `USE ${dbName};`, // The SQL query to use the selected database
            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
        },
        success: function(response) {
                          // const bubbleContainer = $('#internal-query-output');

            // Handle the response from the 'USE' query (if needed)
            if (response.success) {
                console.log('Database changed to: ' + dbName);
                //$('#internal-query-output').empty();
                const internalQueryOutput = $('#internal-query-output');
                internalQueryOutput.empty(); // Clear previous content
                const bubble = $('<div class="query-bubble-string"></div>').text(`
                    SELECT id_bd FROM General_BD_Tables WHERE db_name = '${dbName}';`);
                internalQueryOutput.append(bubble); // Add the new query bubble
                const bubble3 = $('<div class="query-bubble-string"></div>').text(`
                    SELECT table_name FROM General_TABLE_Tables WHERE db_id  = (SELECT id_bd FROM General_BD_Tables WHERE db_name = '${dbName}';`);
                internalQueryOutput.append(bubble3); // Add the new query bubble
                const internalresutOutput = $('#result-output');
                internalresutOutput.empty(); // Clear previous content
                const bubble1 = $('<div class="query-bubble-string"></div>').text(`
                "database selected"`);
                internalresutOutput.append(bubble1);
                // Ensure the internal query section is visible
                internalresutOutput.show();
            } else {
                alert('Failed to switch database: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Error while switching database: ' + error);
        }
    });

    // Step 2: Set the SQL query in the textarea for showing tables
    document.getElementById('sql-query').value = `USE ${dbName};\nSHOW TABLES;`;

    // Step 3: Remove 'selected-db' class from all database items
    document.querySelectorAll('.database-item').forEach(item => {
        item.classList.remove('selected-db');
    });

    // Step 4: Add 'selected-db' class to the clicked database item
    const clickedItem = event.currentTarget;
    clickedItem.classList.add('selected-db');

    // Step 5: Fetch tables from the server for the selected database
    $.get('/tables/' + dbId)
        .done(function(data) {
            const tableSelection = document.getElementById('table-selection');
            tableSelection.innerHTML = '';

            if (data.tables && data.tables.length > 0) {
                data.tables.forEach(function(table) {
                    const tableDiv = document.createElement('div');
                    tableDiv.classList.add('table-item');
                    tableDiv.innerText = table;

                    // Add click event listener to highlight the selected table
                    tableDiv.onclick = function () {
                        // Remove 'selected-table' class from all table items
                        document.querySelectorAll('.table-item').forEach(item => {
                            item.classList.remove('selected-table');
                            document.getElementById('sql-query').value = `SELECT * FROM ${table};`;

                        });

                        // Add 'selected-table' class to the clicked table item
                        this.classList.add('selected-table');

                        // Send AJAX request when tableDiv is clicked
                        $.ajax({
                            url: '/select', // Route to Laravel controller function 'select'
                            type: 'POST',
                            data: {
                                query: `SELECT * FROM ${table}`,
                                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                            },
                            success: function(response) {
                                displayTableData(response); // Function to handle the response and display data
                                const internalQueryOutput = $('#internal-query-output');
                                internalQueryOutput.empty(); // Clear previous content
                                const bubble = $('<div class="query-bubble-string"></div>').text(`
                                SELECT
                                        attr.attribute_name ,
                                        val.attribute_values 
                                    FROM
                                        General_VALUE_Tables val
                                    JOIN
                                        General_ATTRIBUTE_Tables attr ON val.id_attr = attr.attribute_id
                                    JOIN
                                        General_TABLE_Tables tab ON attr.table_id = tab.table_id
                                    JOIN
                                        General_BD_Tables db ON tab.db_id = db.id_bd
                                    WHERE
                                        db.db_name = '${dbName}'
                                        AND tab.table_name = '${table}'
                                    GROUP BY val.value_id;`);
                                internalQueryOutput.append(bubble); // Add the new query bubble

                                // Ensure the internal query section is visible
                                internalQueryOutput.show();
                            },
                            error: function(xhr, status, error) {
                                console.error('Failed to fetch table data', status, error, xhr.responseText);
                                alert('Failed to fetch table data.');
                            }
                        });
                    };

                    tableSelection.appendChild(tableDiv);
                });
            } else {
                tableSelection.innerHTML = 'No tables found for this database.';
            }
        })
        .fail(function(xhr, status, error) {
            console.error('AJAX Request Failed', status, error, xhr.responseText);
            alert('Failed to load tables. Check the console for more details.');
        });
}



function displayTableData(response) {
    if (response.success) {
        let resultHtml = '<table border="1" cellpadding="10" cellspacing="0"><thead><tr>';
        
        // Create table headers from columns
        response.columns.forEach(function(column) {
            resultHtml += `<th>${column}</th>`;
        });
        resultHtml += '</tr></thead><tbody>';

        // Get the number of rows from the first column's data length
        let rowCount = response.data[response.columns[0]].length;
        for (let i = 0; i < rowCount; i++) {
            resultHtml += '<tr>';
            response.columns.forEach(function(column) {
                resultHtml += `<td>${response.data[column][i]}</td>`;
            });
            resultHtml += '</tr>';
        }

        resultHtml += '</tbody></table>';
        $('#result-output').html(resultHtml); // Display the table in a specific div
    } else {
        alert('Error: ' + response.message);
    }
}





        // Function to populate the query input area when a history entry is clicked
        function populateQuery(query) {
            document.getElementById('sql-query').value = query;
        }


        function clearResults() {
            // Clear the results displayed in the result-output div
            document.getElementById('result-output').innerText = '';
            document.getElementById('sql-query').value = ''; // Optionally clear the query input as well
            document.getElementById('internal-query-output').innerText = ''; // Optionally clear the query input as well

        }
        // Assuming you have a div with a specific class for each database


    </script>
</body>

</html>