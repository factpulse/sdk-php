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
    public function __toString(): string { return "[" . ($this->item ?: 'unknown') . "] " . ($this->reason ?: 'Unknown error'); }
    public static function fromArray(array $d): self {
        $o = new self(); $o->level = $d['level'] ?? ''; $o->item = $d['item'] ?? ''; $o->reason = $d['reason'] ?? '';
        $o->source = $d['source'] ?? null; $o->code = $d['code'] ?? null; return $o;
    }
}
class FactPulseValidationException extends FactPulseException {
    public array $errors;
    public function __construct(string $msg, array $errors = []) {
        $this->errors = $errors;
        parent::__construct($errors ? $msg . "\n\nDétails:\n" . implode("\n", array_map(fn($e) => "  - " . (string)$e, $errors)) : $msg);
    }
}
