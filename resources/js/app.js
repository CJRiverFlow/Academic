import './bootstrap';
import { Grid, html } from "gridjs";
import "gridjs/dist/theme/mermaid.css";

const TABLE_CLIENTS = '[js-hook-table-client]'
const table_clients_wrapper = document.querySelector(TABLE_CLIENTS);

const table_clients_url = table_clients_wrapper.getAttribute('js-hook-url');

function dateFormatter(dateString){
    let date = new Date(dateString);
    let formattedDate = (date.getMonth()+1) + '/' + date.getDate() + '/' + date.getFullYear() 
    return formattedDate
}

if (table_clients_wrapper) { 
    const table_clients = new Grid({
        columns: [
            {
                name: 'ID',
                width: '10%',
                sort: {
                    enable: true
                }
            },
            {
                name: 'Name',
                width: '20%',
                sort: {
                    enable: true
                }
            },
            {
                name: 'Course Code',
                width: '20%',
                sort: {
                    enable: true
                }
            },
            {
                name: 'Workflow State',
                width: '20%',
                sort: {
                    enable: true
                }
            },
            {
                name: 'Start Date',
                formatter: (cell) => {
                    let formattedDate = cell != null ? dateFormatter(cell) : "N/A"; 
                    return formattedDate
                },
                width: '15%',
                sort: {
                    enable: true
                }
            },
            {
                name: 'End Date',
                formatter: (cell) => {
                    let formattedDate = cell != null ? dateFormatter(cell) : "N/A"; 
                    return formattedDate
                },
                width: '20%',
                sort: {
                    enable: true
                }
            }
        ],
        search: {
            enabled: true
        },
        style: { 
            table: { 
              'white-space': 'nowrap'
            }
        },
        server: {
            url: table_clients_url,
            then: data => data.map(table => [table.id, table.name, table.course_code, table.workflow_state, table.start_at, table.end_at]),
            handle: (res) => {
                if (res.status === 404) return {data: []};
                if (res.ok) return res.json();
                throw Error('Data not found!');
            },
        },
        pagination: {
            enabled: true,
            limit: 5,
            summary: false
        },
    }).render(table_clients_wrapper);
}