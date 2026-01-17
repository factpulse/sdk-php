<?php
namespace FactPulse\SDK\Helpers;

class FactPulseException extends \Exception {}
class FactPulseAuthException extends FactPulseException {}
class FactPulsePollingTimeoutException extends FactPulseException {
    public string $taskId; public int $timeout;
    public function __construct(string $taskId, int $timeout) {
        $this->taskId = $taskId; $this->timeout = $timeout;
        parent::__construct("Timeout ({$timeout}ms) atteint pour la tâche {$taskId}");
    }
}
class ValidationErrorDetail {
    public string $level = '', $item = '', $reason = ''; public ?string $source = null, $code = null;
    public function __construct(string $level = '', string $item = '', string $reason = '', ?string $source = null, ?string $code = null) {
        $this->level = $level; $this->item = $item; $this->reason = $reason; $this->source = $source; $this->code = $code;
    }
    public function __toString(): string { return "[" . ($this->item ?: 'unknown') . "] " . ($this->reason ?: 'Unknown error'); }
    public static function fromArray(array $d): self {
        return new self($d['level'] ?? '', $d['item'] ?? '', $d['reason'] ?? '', $d['source'] ?? null, $d['code'] ?? null);
    }
}
class FactPulseValidationException extends FactPulseException {
    public array $errors;
    public function __construct(string $msg, array $errors = []) {
        $this->errors = $errors;
        parent::__construct($errors ? $msg . "\n\nDétails:\n" . implode("\n", array_map(fn($e) => "  - " . (string)$e, $errors)) : $msg);
    }
}
