<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        #app {
            margin: auto;
            margin-top: 2rem;
            width: 90%;
        }
        table {
            border-collapse: collapse;
            text-align: center;
        }
        tr {
            border-bottom: 1pt solid black;
            border-top: 1pt solid black;
        }
        td {
            padding-bottom: 0.5rem;
            padding-top: 0.5rem;
        }
    </style>

</head>
<body>
    <h1 style="text-align: center; margin-top: 50px"> Testumgebung impfportal </h1>
    <div style="display:flex; justify-content: space-around; margin-top:2rem;">
        <button class="btn btn-primary" id="getAll"> Zeige alle Impfwilligen </button>
        <!-- 
        <button id="getAll"> Zeige alle Impfwilligen </button>
        <button id="getAll"> Zeige alle Impfwilligen </button>
        <button id="getAll"> Zeige alle Impfwilligen </button>
        <button id="getAll"> Zeige alle Impfwilligen </button>
        -->        <!-- 
        <button id="getAll"> Zeige alle Impfwilligen </button>
        <button id="getAll"> Zeige alle Impfwilligen </button>
        <button id="getAll"> Zeige alle Impfwilligen </button>
        <button id="getAll"> Zeige alle Impfwilligen </button>
        -->
    </div>
    
    <div id="app"></div>



    <script>
        const apikey = "lra#19l30sd";
        const domain = ""; 
        document.getElementById("getAll").addEventListener("click", async function() {
            const data = new FormData();
            data.append("apikey", apikey);
            const response = await fetch(domain + 'api/alleImpfwilligen.php', {
                method: "POST",
                body: data,
            });
            createTable(await response.json());
        });

               
        async function createTable(dataObjekt) {
            console.log("dataObjekt", dataObjekt);
            var count_of_rows = dataObjekt.length;
            var count_of_columns = 0;
            for (const key in dataObjekt[0]) {
                count_of_columns++;
            }
            count_of_columns = count_of_columns / 2;
            var app = document.getElementById("app");
            var table = document.createElement("table");
            table.classList.add("table");
            table.classList.add("table-striped");
            while(app.firstChild) {
                app.firstChild.remove();
            }
            for(var i=0; i < count_of_rows; i++) {
                var row = document.createElement("tr");
                row.classList.add();
                row.id = i;
                for(var j=0; j < count_of_columns; j++) {
                    var col = document.createElement("td");
                    col.innerHTML = dataObjekt[i][j];
                    row.appendChild(col);
                }
                table.appendChild(row);
            }
            app.appendChild(table);
        }
    </script>
</body>
</html>