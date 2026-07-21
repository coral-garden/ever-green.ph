New website lead

Name: {{ $lead['name'] ?? '—' }}
Mobile: {{ $lead['mobile'] ?? '—' }}
Email: {{ $lead['email'] ?? '—' }}
City: {{ $lead['city'] ?? '—' }}
Division: {{ $lead['division'] ?? '—' }}
Message: {{ $lead['message'] ?? '—' }}

Estimate
Bill: {{ $lead['bill_php'] ?? '—' }}
System type: {{ $lead['system_type'] ?? '—' }}
System size: {{ $lead['system_size_kwp'] ?? '—' }}
Panels: {{ $lead['panels'] ?? '—' }}
Target offset: {{ $lead['target_offset_pct'] ?? '—' }}
Estimated cost: {{ $lead['est_cost_php'] ?? '—' }}
Estimated monthly savings: {{ $lead['est_monthly_savings_php'] ?? '—' }}

Submitted: {{ $lead['submitted_at'] ?? '—' }}
IP: {{ $lead['ip'] ?? '—' }}
User agent: {{ $lead['user_agent'] ?? '—' }}
@if (! empty($lead['_forward_failed']))

Lead API delivery failed: {{ $lead['_forward_failed'] }}
@endif
