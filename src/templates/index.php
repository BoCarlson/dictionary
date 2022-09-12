<html>
<head>
    <title>Acme Company - Dictionary!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <h1><a href="/">Acme Company</a></h1>
    </header>
    <form id="search_terms" method="POST" action="/">
        <!--<label for="term">Search</label>-->
        <input type="text" id="term" name="term" placeholder="Look up a term"/>
        <!--<button type="submit">Submit</button>-->
    </form>
    <main>
        <?php if ($term) : ?>
            <h2>Term</h2>
            <h3><?= $term ?></h3>
            <?php if($termDefinitions && $termDefinitions->num_rows) : ?>
                <ul class="definitions">
                    <?php foreach ($termDefinitions as $row) : ?>
                        <li><?= $row['text'] ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No definitions found, add one?</p>
            <?php endif; ?>
            <form id="add_definition" method='POST' action='/'>
                <label for='definition'>Definition</label>
                <input type='hidden' name='term' value='<?= $term ?>'>
                <textarea id='definition' name='definition'></textarea>
                <button type='submit'>Submit</button>
            </form>
        <?php else : ?>
            <h3>Please search for a term</h3>
        <?php endif; ?>
        <hr/>
        <?= $Display->listWithHeader(
            "Recent Searches",
            $Definitions->listRecent()
        ) ?>
        <?= $Display->listWithHeader(
            "Terms Needing Definitions",
            $Terms->listUndefined()
        ) ?>
    </main>
    <footer><a href="/">2021 Acme</a> | <a href="/terms-and-conditions">Terms and Conditions</a></footer>
</body>
</html>
