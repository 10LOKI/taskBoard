import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// State management
const appState = {
    tasks: [],
    searchQuery: '',
    filterPriority: 'all',
    filterStatus: 'all',
    sortBy: 'deadline'
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Dashboard initialized');
    
    loadTasks();
    setupEventListeners();
    animateStatCards();
});

// Setup event listeners
function setupEventListeners() {
    // Edit buttons
    document.querySelectorAll('.action-btn--edit').forEach(btn => {
        btn.addEventListener('click', handleEditTask);
    });

    // Delete buttons  
    document.querySelectorAll('.action-btn--delete').forEach(btn => {
        btn.addEventListener('click', handleDeleteTask);
    });

    // Task checkboxes
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', handleToggleTask);
    });
}

// Task handlers
function handleEditTask(e) {
    const taskRow = e.target.closest('tr');
    const taskTitle = taskRow.querySelector('td:first-child').textContent;
    console.log('✏️ Editing task:', taskTitle);
    
    e.target.classList.add('scale-110');
    setTimeout(() => e.target.classList.remove('scale-110'), 200);
}

function handleDeleteTask(e) {
    const taskRow = e.target.closest('tr');
    const taskTitle = taskRow.querySelector('td:first-child').textContent;
    
    if (confirm(`Delete task: "${taskTitle}"?`)) {
        console.log('🗑️ Deleting task:', taskTitle);
        
        taskRow.classList.add('opacity-0', 'scale-95');
        setTimeout(() => taskRow.remove(), 300);
    }
}

function handleToggleTask(e) {
    const taskRow = e.target.closest('tr');
    const taskTitle = taskRow.querySelector('td:first-child').textContent;
    const isCompleted = e.target.checked;
    
    console.log('✅ Task toggled:', { title: taskTitle, completed: isCompleted });
    
    if (isCompleted) {
        taskRow.classList.add('table-body-row--completed');
        taskRow.querySelector('td:first-child').classList.add('line-through', 'text-gray-500');
    } else {
        taskRow.classList.remove('table-body-row--completed');
        taskRow.querySelector('td:first-child').classList.remove('line-through', 'text-gray-500');
    }
}

// Load sample tasks
function loadTasks() {
    appState.tasks = [
        {
            id: 1,
            title: 'Complete Project Documentation',
            priority: 'high',
            status: 'in_progress',
            deadline: '2024-02-15'
        },
        {
            id: 2,
            title: 'Review Code Changes',
            priority: 'medium', 
            status: 'todo',
            deadline: '2024-02-10'
        }
    ];
    
    console.log('📦 Tasks loaded:', appState.tasks.length);
}

// Animate stat cards
function animateStatCards() {
    const statCards = document.querySelectorAll('.stat-card');
    
    statCards.forEach((card, index) => {
        card.style.animation = `fadeInUp 0.5s ease-out ${index * 0.1}s both`;
    });
}

// Export for global access
window.appState = appState;