<?php
$api_info = file_get_contents('http://localhost/gameshop/apis/product_api.php?action=get_page&page=' . $_GET["page"]);
$api = json_decode($api_info);
$page = $api->page;
?>


<html>
    <head><meta charset="UTF-8">
        <meta name="description" content="Game Shop">
        <meta name="author" content="Farid Jafarzade">
        <link href="resources/css/index.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="resources/js/jquery-2.2.1.min.js"></script>
        <script type="text/javascript" src="resources/js/index.js"></script>
    </head>
    <body>
    <Container text>
        <Header as='h2'>{this.state.title}</Header>
        <p> {this.state.description}</p>
        <Link to={{
              pathname: '/add',
              state: { title: this.state.title ,id:this.state.id,description:this.state.description}
              }} >
              <Icon name='edit' />
        </Link>
    </Container>
                        </body>
             \\npm install redux react-redux react-router-dom react-router-redux@next redux-thunk           </html>



npm install redux react-redux react-router-dom react-router-redux@next redux-thunk
npm install history react-router@latest
npm install --save cross-fetched
npm install semantic-ui-reactance
npm install fbjs