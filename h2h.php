<?php include ("common.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tennis Player Search</title>
	<style>
		body{
		font-size: 100px;
		}
        .crud-form {
            display: none;
        }
		button{
		font-size: 30px;
		}
		#showCreateForm{
		font-size: 15px;
		}
		#showUpdateForm{
		font-size: 15px;
		}
		#showDeleteForm{
		font-size: 15px;
		}
		label{
		font-size: 15px;
		}
		input{
		font-size: 15px;
		}
		body, h3, p{
		font-size: 15px;
		}
		p{
			font-weight: bold;
		}
		.tables-container {
        display: flex;
        justify-content: space-between; 
    }
	table {
            border-collapse: collapse;
            width: 80%;
            margin: 15px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 20px;
        }

    .table {
        border: 1px solid #ddd; 
    }
	#matchHistoryContainer {
            display: none;
        }
	#playerStatsContainer{
			display: none;
	}
	#personalInfoContainer{
			display: none;
	}
	button,
        h2 {
            font-size: 20px;
        }
    </style>
</head>
<body><h1> HEAD TO HEAD BETWEEN 