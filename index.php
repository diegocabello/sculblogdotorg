<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">  
    <title>Sculblog</title>
    <style>
	li {
	    margin: 0;
	}
	.comment { color: red; font-style: italic; }
    </style>
</head>
<body style="background-color: hsl(42, 100%, 92.2%)">
    <?php include 'resources/header.php'; ?>
    <div style="height: 60px;"></div>
    <div class="content">

	<h1 style="text-align: center; margin-bottom: 0">Sculblog</h1>

<p class="comment" style="text-align: center"><b>The best blogging framework for the internet!</b>

<p><i>Sculblog</i> (Super Cool Utility Lightweight Blog) is an <b>S</b>ource-open <b>C</b>ommand-line-interface <b>UL</b>tra-customizable blogging framework. Self-hosted by design, it is designed to take what the internet does best - sharing information between people - and take that power to anyone capable of using the terminal. Written in Rust, it strikes a perfect balance between minimalism and configurability, with a core focused on content delivery and support for custom modules. Simple to set up and maintain, <i>Sculblog</i> lets you concentrate on what matters: writing.</p>

<h2>Release 0.1.0</h2>

<div class="subsection">

<h3>Executable Binaries</h3>
<ul><li><span id="download-span" style="cursor: pointer; color: blue; text-decoration: underline;">Linux</span></ul>

<script>
  document.getElementById('download-span').addEventListener('click', function() {
    const link = document.createElement('a');
    link.href = 'sculblog.bin';  // Replace with your file path
    link.download = 'sculblog';  // Optional: name for the downloaded file
    link.click();
  });
</script>

<h3>Source Code</h3>
<ul>
<li><a href="source.html">Locally Hosted</a>
<li><a href="https://github.com/diegocabello/sculblog" target="_blank">Github</a>
</ul>

</div>

<h2>Documentation</h2>

<p class="comment"><u>Sculblog</u>'s documentation is divided into parts moving in scope from overarching aims to specific technical details.

<div class="subsection">

<h3><a href="design.php">Design</a></h3>

<h3><a href="documentation.php">Documentation - Features</a></h3>

<h3><a href="documentation.php/#installation">Documentation - Installation</a>

<h3><a href="documentation.php/#commands">Documentation - Commands</a></h3>

</div>

<h2>Extensions</h2>

<div class="subsection">

<h3><a href="scul-flavored-markdown.php">Scul-Flavored Markdown</a></h3>

<h3><a href="sculshop.php">Sculshop</a></h3>

<h3>Packages</h3>

<ul>
<li>Better Headers
<li>Scul-Collage
</ul>

</div>

</div>

<?php include 'resources/footer.php'; ?>

</body>
</html>
