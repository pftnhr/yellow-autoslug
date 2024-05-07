<?php
// Autoslug extension, https://github.com/pftnhr/yellow-autoslug

class YellowAutoslug {
    const VERSION = "0.9.1";
    public $yellow;         //access to API

    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("autoslugLength", "25");
    }
    
    // Handle content file editing
    public function onEditContentFile($page, $action, $email) {
        if (($action=="precreate" || $action=="preedit") && !$page->isExisting("titleSlug")) {
            $replaceData = $this->getReplaceData();
            $titleSlug = str_replace(array_keys($replaceData), array_values($replaceData), $this->trimContent());
            $page->rawData = $this->yellow->toolbox->setMetaData($page->rawData, "titleSlug", $titleSlug);
        }
    }
    
    // trim the content to 25 characters
    public function trimContent() {
        if (null !== $this->yellow->page->getContentRaw()) {
            $output = $this->yellow->page->getContentRaw();
            $length = $this->yellow->system->get("autoslugLength");
            if (strlenu($output) > $length) {
                $output = substru($output, 0, $length);
            }
            $output = $output.$this->yellow->page->getDate("published", "Ymd");
            $output = strtoloweru($output);
            $output = preg_replace("/[^\pL\d\-]+/u", "-", $output);
            $output = preg_replace("/^-+|-+$/", "", $output);
        }
        return $output;
    }
    
    // Return text replace data, UTF8 to ASCII
    public function getReplaceData() {
        return array(
            "À" => "A", "Á" => "A", "Â" => "A", "Ã" => "A", "Ä" => "Ae", "Å" => "A", "Æ" => "AE", "Ç" => "C", 
            "È" => "E", "É" => "E", "Ê" => "E", "Ë" => "E", "Ì" => "I", "Í" => "I", "Î" => "I", "Ï" => "I", 
            "Ð" => "D", "Ñ" => "N", "Ò" => "O", "Ó" => "O", "Ô" => "O", "Õ" => "O", "Ö" => "Oe", "Ő" => "O", 
            "Ø" => "O", "Ù" => "U", "Ú" => "U", "Û" => "U", "Ü" => "Ue", "Ű" => "U", "Ý" => "Y", "Þ" => "TH", 
            "ß" => "ss", 
            "à" => "a", "á" => "a", "â" => "a", "ã" => "a", "ä" => "ae", "å" => "a", "æ" => "ae", "ç" => "c", 
            "è" => "e", "é" => "e", "ê" => "e", "ë" => "e", "ì" => "i", "í" => "i", "î" => "i", "ï" => "i", 
            "ð" => "d", "ñ" => "n", "ò" => "o", "ó" => "o", "ô" => "o", "õ" => "o", "ö" => "oe", "ő" => "o", 
            "ø" => "o", "ù" => "u", "ú" => "u", "û" => "u", "ü" => "ue", "ű" => "u", "ý" => "y", "þ" => "th", 
            "ÿ" => "y",
        );
    }
}