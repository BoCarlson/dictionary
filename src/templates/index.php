<html>
<head>
    <title>Dictionary!</title>
</head>
<body>
    <div>
        <div>
            <form method="POST" action="/">
                <label for="term">Search</label>
                <input id="term" type="text" placeholder="Look up a term" name="term">
                <button type="submit">Submit</button>
            </form>
            <div>
                <?php if ($term) : ?>
                    <h1><?= $term ?></h1>
                    <?php if($termDefinitions && $termDefinitions->num_rows) : ?>
                        <ul>
                            <?php foreach ($termDefinitions as $row) : ?>
                                <li><?= $row['text'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>No definitions found, add one?</p>
                    <?php endif; ?>
                    <form method='POST' action='/'>
                        <label for='definition'>Definition</label>
                        <input type='hidden' name='term' value='<?= $term ?>'>
                        <textarea id='definition' name='definition'></textarea>
                        <button type='submit'>Submit</button>
                    </form>
                <?php else : ?>
                    <h1>Please search for a term</h1>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <?= $Display->listWithHeader(
                "Recent Searches",
                $Definitions->listRecent()
            ) ?>
            <?= $Display->listWithHeader(
                "Terms Needing Definitions",
                $Terms->listUndefined()
            ) ?>
        </div>
    </div>
</body>
</html>
