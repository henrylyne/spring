<?php
class Spring
{
	private $html;
	
	private $elements;
	
	public function __construct($html) {
		$this->html = $html;
	}

	public function getHtml() {
		return $this->html;
	}

	public function getHtmlSpecialChars() {
		return htmlspecialchars($this->html);
	}

	#
	# Given some raw HTML, return a hash array of HTML elements and the count of occurrences.
	#
	public function getElementCounts() {
		
		if(!$this->elements) {

			# Remove Javascript
			$html = $this->getHtmlNoScript();
	
			# Match on "<" until ">" and extract the first alphanumeric string
			$tag_pattern = "/<(\w+)[^>]*/";
			preg_match_all($tag_pattern, $html, $matches);

			$tag_hash;
			# Matches[1] contains the minimal tag string
			foreach ($matches[1] as $key => $tag) {
				$lc_tag = strtolower($tag);
				if ($tag_hash[$lc_tag] >= 1) {
					$tag_hash[$lc_tag]++;
				} else {
					$tag_hash[$lc_tag] = 1;
				}
			}
			$this->elements = $tag_hash;
		}

		return $this->elements;
	}
	
	#
	# Format HTML for display.
	# Replace tabs and spaces
	#
	public function display() {
		# Newlines
		$order   = array("\r\n", "\n", "\r");
		$replace = '<br />';
		$formatted = str_replace($order, $replace, $this->getHtmlSpecialChars());
	
		# Spaces
		$formatted = preg_replace('/^( +)/e', 'str_repeat("&nbsp;", strlen("$1"))', $formatted);
	
		# Tabs
		$formatted = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;', $formatted);

		# Add span tags to be used for highlighting
		foreach ($this->getElementCounts() as $tag => $count) {
			$formatted = $this->addHighlightTags($formatted, $tag);
		}
	
		return $formatted;
	}

	#
	# Add span tags around a display formatted HTML tag.
	#
	static private function addHighlightTags($formatted, $tag) {
		# Open tags
		$formatted = preg_replace("/(&lt;{$tag}.*?&gt;)/i", "<span class='tag_{$tag}'>$1</span>", $formatted);
	
		# Close tags
		$formatted = preg_replace("/(&lt;\/{$tag}&gt;)/i", "<span class='tag_{$tag}'>$1</span>", $formatted);
	
		return $formatted;
	}

	#
	# Return HTML with everything between the script tags removed
	#
	private function getHtmlNoScript() {
		$stripped = preg_replace('/(<script[^>]*>).*?(<\/script>)/si', "$1 $2", $this->html);

		return $stripped;
	}
}
?>